<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ClearancePurpose;
use App\Models\SubRole;
use App\Models\User;
use App\Models\Clearance;
use App\Models\ClearanceOfficial;


class ClearanceController extends Controller
{
    public function index(){

        $purposes = map_options(ClearancePurpose::class, 'id', 'description');
        // $subRoles = map_options(SubRole::class, 'id', 'description');

        //1:1 subrole, exclude active subrole
        $excludedSubRoles = User::where('status', 1)->pluck('sub_role')->toArray();

        $subRoles = SubRole::whereIn('id', $excludedSubRoles)->get()->map(function ($subrole) {
            return [
                'id' => $subrole->id,
                'name' => $subrole->description,
            ];
        });

        return view('pages.hr.clearance.clearance_form.index', compact('purposes', 'subRoles'));
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'description' => 'required|string|max:255',
            'purpose' => 'required|integer',
            'statement' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return back()->with('error', implode('<br>', $validator->errors()->all()));
        }

        $clearingOfficial = $request->input('clearing_official', []);

        // handle duplicates in clearing_official
        $uniqueClearingOfficials = array_unique($clearingOfficial);
        if (count($clearingOfficial) !== count($uniqueClearingOfficials)) {

            return redirect()->back()->with('error', 'Duplicate clearing officials are not allowed.');
        }

        $clearance = Clearance::create([
            'description' => $request->description,
            'purpose' => $request->purpose,
            'statement' => $request->statement
        ]);

        $seqno = $request->input('seqno', []);
        $title = $request->input('title', []);

        $totalRows = count($seqno);


        foreach ($seqno as $index => $seq) {
            ClearanceOfficial::create([
                'clearance_id' => $clearance->id,  
                'seqno' => $seqno[$index],
                'title' => $title[$index],
                'clearing_official' => $clearingOfficial[$index],
            ]);
        }

        return redirect()->back()->with('success', 'Clearance officials saved successfully.');


    }

    public function update(Request $request){
        
    }
}
