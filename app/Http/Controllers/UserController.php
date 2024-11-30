<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Role;
use App\Models\SubRole;


class UserController extends Controller
{
    public function index (){

        $users = User::with(['role', 'subrole'])->where("status", 1)->get();

        return view('pages.hr.users.index', compact('users'));
    }

    public function create(){

        $roles = map_options(Role::class, 'id', 'name');
        $subroles = map_options(SubRole::class, 'id', 'description');

        return view('pages.hr.users.create', compact('roles', 'subroles'));

    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'role' => 'required|exists:roles,id',
            'subrole' => 'required|exists:sub_roles,id',
            'emailaddress' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->with('error', implode('<br>', $validator->errors()->all()));
        }

        return back()->with('success', 'Sucessfully Added!');
    }
}