<?php

namespace App\Http\Controllers;

use App\Models\Clearance;
use App\Models\ClearanceApproval;
use Illuminate\Http\Request;
use App\Models\ClearanceRequest;

class RequestController extends Controller
{
    public function index(){

        $requests = ClearanceRequest::with(['user','employmentType','clearance_purpose', 'statusDesc'])->where('status', 1)->get();

        return view('pages.hr.clearance.requests.index', compact('requests'));
    }

    public function update_status(Request $request, $id){

        try {
            $status = $request->input('status');  
            $clearance_request = ClearanceRequest::find($id);
            if ($status == 'approved') {

                $clearance_request->update(['status' => 2]);
                
                $clearance = Clearance::with(['officials'])->where('employment_type', $clearance_request->employment_type)->first();
                $officials = $clearance->officials;

                if(!empty($officials)){

                    $officials = collect($officials)->sortBy('seqno')->values(); 

                    foreach($officials as $official){

                        ClearanceApproval::create([
                            'request_id' => $id,
                            'clearance_id' => $clearance->id,
                            'employee_type' => $clearance_request->employment_type,
                            'seqno' => $official->seqno,
                            'clearing_official_user_id' => $clearance_request->user_id,
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
}
