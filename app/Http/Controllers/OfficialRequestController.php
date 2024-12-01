<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OfficialRequestController extends Controller
{
    public function index()
    {
        return view('pages.official.request-clearance.index');
    }
}
