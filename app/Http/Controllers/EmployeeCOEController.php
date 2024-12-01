<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeCOEController extends Controller
{
    public function index()
    {
        $hasClearance = false;

        return view('pages.employee.certificate.index', compact('hasClearance'));
    }
}
