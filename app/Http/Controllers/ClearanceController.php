<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClearancePurpose;

class ClearanceController extends Controller
{
    public function index(){

        $purposes = map_options(ClearancePurpose::class, 'id', 'description');

        return view('pages.hr.clearance.clearance_form.index', compact('purposes'));
    }
}
