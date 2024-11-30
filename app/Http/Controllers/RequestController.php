<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClearanceRequest;

class RequestController extends Controller
{
    public function index(){

        $requests = ClearanceRequest::with(['user','employmentType','clearance_purpose', 'statusDesc'])->where('status', 1)->get();

        return view('pages.hr.clearance.requests.index', compact('requests'));
    }

    public function update_status(Request $request, $id){

        $status = $request->input('status');  
    
        // if ($status == 'approved') {
        //     $request = ClearanceRequest::find($id);
        //     $request->update('status', )
        // } else if ($status == 'disapproved') {
            
        // }
    }
}
