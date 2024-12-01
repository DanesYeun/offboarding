<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClearanceRequest;
use App\Models\ClearanceApproval;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OfficialRequestController extends Controller
{
    public function index()
    {
        $clearanceRequest= ClearanceRequest::with(['clearance_purpose','statusDesc','comment_request'])->get();

//  dd($clearanceRequest);

        $user =Auth::user();

        
        $clearanceRequest = ClearanceRequest::join('users', 'users.id', '=', 'clearance_requests.user_id')
        ->join('clearance as clr', 'clr.id', '=', 'clearance_requests.clearance_id')
        ->join('employment_types as emp', 'emp.id', '=', 'clr.employment_type')
        ->join('clearance_purpose as cp', 'cp.id', '=', 'clearance_requests.purpose')
        ->join('statuses as st', 'st.id', '=', 'clearance_requests.status')
     

        ->select(
            'clearance_requests.id',
            'users.name',
            'users.sub_role',
            'emp.description as employment_description',
            'cp.description as clearance_purpose_description',
            'clearance_requests.created_at',
            'st.description as status_description',
            'clearance_requests.attachment_file_path',
            'st.id as status_id',
            DB::raw('(SELECT MAX(t1.seqno) FROM clearance_approvals t1 WHERE t1.request_id = clearance_requests.id) AS last_sequence'),
            DB::raw('(select clearing_official_id from clearance_approvals where request_id = clearance_requests.id and isApproved != 1 limit 1 ) AS clearing_official_id'),
            DB::raw('(select seqno from clearance_approvals where request_id = clearance_requests.id and isApproved != 1 limit 1) AS seqno'),
            DB::raw('(select comment from comment where comment.clearance_requests_id = clearance_requests.id order by created_at desc limit 1) AS comment')
        ) // Selecting specific fields
        ->get();

    
    //   dd($results);

        return view('pages.official.request-clearance.index', compact('clearanceRequest'));
    }
}
