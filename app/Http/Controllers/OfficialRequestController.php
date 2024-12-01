<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClearanceRequest;

class OfficialRequestController extends Controller
{
    public function index()
    {
        $clearanceRequest= ClearanceRequest::with(['clearance_purpose','statusDesc','comment_request'])->get();
        return view('pages.official.request-clearance.index', compact('clearanceRequest'));
    }
}
