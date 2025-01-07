<?php

namespace App\Http\Controllers;

use App\Models\ClearanceApproval;
use App\Models\ClearancePurpose;
use App\Models\ClearanceRequest;
use App\Models\EmploymentType;
use App\Models\Clearance;
use App\Models\ClearanceCompletedRequirements;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EmployeeRequestClearanceController extends Controller
{
    public function index()
    {
        $purposes = map_options(ClearancePurpose::class, 'id', 'description');
        $employment_types = map_options(EmploymentType::class, 'id', 'description');
        $clearance_request = ClearanceRequest::with(['hr_requirements','completed_requirements'])->where('user_id', auth()->id())->first();
        // dd(json_decode($clearance_request));
        if(!is_null($clearance_request))
        {
            $clearance_approvals = ClearanceApproval::where('request_id', $clearance_request->id)
                ->get();
        } else {
            $clearance_approvals = null;
        }

        return view('pages.employee.clearance.index', compact('purposes', 'employment_types', 'clearance_request', 'clearance_approvals'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'clearance_id' => 'required',
            'attachment' => 'required|file|mimes:pdf|max:10240',
            'remarks' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            \Log::error('Clearance Request Validation Failed', [
                'errors' => $validator->errors(),
                'input' => $request->all()
            ]);
            return redirect()->back()->with('error', 'Oh no! An error occurred');
        }

        $data = $request->only(['clearance_id', 'purpose', 'remarks']);
        $data['status'] = 1; 

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            
            $filePath = $file->storeAs('attachments', $fileName, 'public');
            
            $data['attachment_file_path'] = $filePath;
        }

        $user = auth()->user();

        try {
            $user->clearance_requests()->create($data);
        } catch (\Exception $e) {
            \Log::error('Error saving clearance request', [
                'error' => $e->getMessage(),
                'data' => $data
            ]);
            
            return redirect()->back()->with('error', 'There was an issue saving your request');
        }

        return redirect()->back()->with('success', 'Clearance Request created successfully.');
    }

    public function upload_requirements(Request $request, $id){

        // dd($request->file('attachments'));
        // Validate the attachments
        $request->validate([
            'attachments.*' => 'file|mimes:doc,docx|max:2048', 
        ]);

        $requests = ClearanceCompletedRequirements::where('clearance_request_id', $id)->get();

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
                $filePath = $file->storeAs('completed_requirements', $fileName, 'public');

                // Add the file path to the uploaded files array
                $uploadedFiles[] = [
                    'file_name' => $fileName,
                    'file_path' => $filePath,
                ];
            }
        }

        // Store the paths in the database or handle the data as needed
        foreach ($uploadedFiles as $uploadedFile) {
            ClearanceCompletedRequirements::create([
                'clearance_request_id' => $id,
                'file_name' => $uploadedFile['file_name'],
                'file_path' => $uploadedFile['file_path'],
            ]);
        }

        return redirect()->back()->with('success', 'Files uploaded successfully.');
    }

}
