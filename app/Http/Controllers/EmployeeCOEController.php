<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeCOEController extends Controller
{
    public function index()
    {
        $hasClearance = false; // Example condition for COE availability

        if ($hasClearance) {
            session()->flash('success', 'You can now generate and download your COE!');
        } else {
            session()->flash('info', 'No available COE!');
        }

        return view('pages.employee.certificate.index');
    }
}
