<?php

namespace App\Http\Controllers;

use App\Models\Clearance;
use App\Models\ClearanceApproval;
use Illuminate\Http\Request;
use App\Models\ClearanceRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class RequestController extends Controller
{
    public function index(){

        $requests = ClearanceRequest::with(['user','clearance_purpose', 'statusDesc', 'clearance.employment_type_desc', 'clearance_approvals','clearance_approvals.sub_role'])->orderBy('status', 'ASC')->orderBy('created_at', 'DESC')->get();
       
       
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

    public function certificate_of_employment(){
        
        $requests = ClearanceRequest::with(['user'])->where('status', 5)->whereNull('generated_coe_path')->get();

        return view('pages.hr.certificate.index', compact('requests'));
    }

    public function generate_certificate_of_employment(Request $request, $id)
    {
        $requests = ClearanceRequest::with(['user'])->find($id);
        $data = [
            'name' => $requests->user->name,
            'job_title' => $request->job_title,
            'date' => $request->date,
        ];

        $pdf = Pdf::loadView('pages.hr.certificate.coe', $data);

        $fileName = 'coe_' . $requests->id . '_' . time() . '.pdf';
        $filePath = $fileName; 

        Storage::put('coe/' . $filePath, $pdf->output()); 

        $requests->update(['generated_coe_path' => $filePath]);

        // Stream the PDF to the browser
        return $pdf->stream($fileName);
    }

}
