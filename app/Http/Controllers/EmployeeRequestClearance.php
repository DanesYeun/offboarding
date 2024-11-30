<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeRequestClearance extends Controller
{
    public function index()
    {
        return view('pages.employee.clearance.index');
    }
}
