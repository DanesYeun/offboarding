<?php

namespace App\Http\Controllers;

use App\Models\Clearance;
use App\Models\ClearanceApproval;
use App\Models\ClearanceHrRequirement;
use Illuminate\Http\Request;
use App\Models\ClearanceRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class RequestController extends Controller
{
    public function index(){

        $requests = ClearanceRequest::with(['user','clearance_purpose', 'statusDesc', 'clearance.employment_type_desc', 'clearance_approvals','clearance_approvals.sub_role', 'hr_requirements', 'completed_requirements'])->orderBy('status', 'ASC')->orderBy('created_at', 'DESC')->get();
       
        // dd(json_decode($requests));  
        return view('pages.hr.clearance.requests.index', compact('requests'));
    }

    public function update_status(Request $request, $id){

        try {
            $status = $request->input('status');  
            $clearance_request = ClearanceRequest::with(['clearance.employment_type_desc'])->find($id);

            if ($status == 'approved') {

                $clearance_request->update(['status' => 2]);
                
                $clearance = Clearance::with(['officials'])->where('id', $clearance_request->clearance_id)->first();
                // dd(json_decode($clearance));
                $officials = $clearance->officials;

                if(!empty($officials)){

                    $officials = collect($officials)->sortBy('seqno')->values(); 

                    foreach($officials as $official){

                        ClearanceApproval::create([
                            'request_id' => $id,
                            'seqno' => $official->seqno,
                            'clearing_official_id' => $official->clearing_official,
                            'comment' => null,
                            'isApproved' => 0
                        ]);
                    }
                }

                return redirect()->back()->with('success', 'Clearance request successfully approved.');

            } else if ($status == 'disapproved') {
                $clearance_request->update(['status' => 3]);
                return redirect()->back()->with('success', 'Clearance request successfully disapproved.');
            }


        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function official_update_status(Request $request, $id){

        $status = $request->input('status');  
        $request_id = $request->input('request_id');

        $seqno = $request->input('seqno');  
        $last_seqno = $request->input('last_seqno');  

        $user =Auth::user();
        if ($status == 'approved') {
            $status_for_hr = ClearanceRequest::where('id',$request_id)->update(['status' => 3]);
            if($seqno == $last_seqno){
                $check = ClearanceApproval::where('isApproved', 0)
                ->join('users','users.sub_role','=','clearing_official_id')
                ->where('request_id', $request_id)
                ->where('status', 4)
                ->get();
                if($check->count() > 0){
                    return redirect()->back()->with('error', 'Waiting on leave clearing official to approved.' );
                    // dd($check->name );
                  
                }else{

                    $clearanceapproval = ClearanceApproval::where('clearing_official_id', $user->sub_role)
                    ->where('request_id',$request_id)
                    ->update(['isApproved' => 1]);

                    ClearanceRequest::where('id',$request_id)
                    ->update(['status' => 4]);
                    return redirect()->back()->with('success', 'Clearance request successfully approved.');
                }

            }else{
                $clearanceapproval = ClearanceApproval::where('clearing_official_id', $user->sub_role)
                ->where('request_id',$request_id)
                ->update(['isApproved' => 1]);
    
            }
            return redirect()->back()->with('success', 'Clearance request successfully approved.');
        } 
    }

    public function certificate_of_employment(){
        
        $requests = ClearanceRequest::with(['user'])->where('status', 5)->whereNull('generated_coe_path')->get();
        $departments = $this->deparments();

        return view('pages.hr.certificate.index', compact('requests', 'departments'));
    }

    public function generate_certificate_of_employment(Request $request, $id)
    {
 
        $departments = $this->deparments();
        $department = collect($departments)->firstWhere('id', $request->department);
        $departmentTypeName = $department ? $department['name'] : null;
        
        $requests = ClearanceRequest::with(['user'])->find($id);
        $data = [
            'name' => $requests->user->name,
            'job_title' => $request->job_title,
            'date' => $request->date,
            'employement_type' => $request->employement_type,
            'department' => $departmentTypeName
        ];

        $pdf = Pdf::loadView('pages.hr.certificate.coe', $data);

        $fileName = 'coe_' . $requests->id . '_' . time() . '.pdf';
        $filePath = $fileName; 

        Storage::put('coe/' . $filePath, $pdf->output()); 

        $requests->update(['generated_coe_path' => $filePath]);

        // Stream the PDF to the browser
        return $pdf->stream($fileName);
    }

    public function upload_certificate_of_employment (Request $request)
    {
        $request->validate([
            'request_id' => 'required|exists:clearance_requests,id',
            'coe_file' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);
    
        $clearanceRequest = ClearanceRequest::with(['user'])->findOrFail($request->request_id);
     
        if ($request->hasFile('coe_file')) {
            $fileName = 'coe_' . $request->employee_id . '_' . time() . '.' . $request->file('coe_file')->getClientOriginalExtension();
            $filePath = $request->file('coe_file')->storeAs('coe', $fileName, 'public');

            $clearanceRequest->update(['generated_coe_path' => $filePath]);
        }
    
        return redirect()->back()->with('success', 'Certificate uploaded successfully!');
    }

    public function upload_hr_requirments(Request $request, $id){

        // dd($request->file('attachments'));
        // Validate the attachments
        $request->validate([
            'attachments.*' => 'file|mimes:doc,docx|max:2048', 
        ]);

        $requests = ClearanceHrRequirement::where('clearance_request_id', $id)->get();

         // Check if there are existing files and delete them
        if (!$requests->isEmpty()) {
            foreach ($requests as $existingFile) {
                
                Storage::delete($existingFile->file_path);
                $existingFile->delete();
            }
        }

        $uploadedFiles = [];
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {

                $fileName = $file->getClientOriginalName();

                // Store the file in the 'requirements' directory in the 'public' disk
                $filePath = $file->storeAs('requirements', $fileName, 'public');

                // Add the file path to the uploaded files array
                $uploadedFiles[] = [
                    'file_name' => $fileName,
                    'file_path' => $filePath,
                ];
            }
        }

        // Store the paths in the database or handle the data as needed
        foreach ($uploadedFiles as $uploadedFile) {
            ClearanceHrRequirement::create([
                'clearance_request_id' => $id,
                'file_name' => $uploadedFile['file_name'],
                'file_path' => $uploadedFile['file_path'],
            ]);
        }

        return redirect()->back()->with('success', 'Files uploaded successfully.');
    }

    private function deparments(){
        return [
            ['id' => 1, 'name' => 'Department of Technology'],
            ['id' => 2, 'name' => 'Department of Agriculture'],
            ['id' => 3, 'name' => 'Department of Engineering'],
            ['id' => 4, 'name' => 'Department of Education'],
            ['id' => 5, 'name' => 'Department of Arts and Sciences'],
        ];
    }

}
