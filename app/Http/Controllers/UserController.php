<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\SubRole;
use App\Http\Controllers\SendMailController;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index (){

        $users = User::with(['role', 'subrole'])->where("status", 1)->get();

        return view('pages.hr.users.index', compact('users'));
    }

    public function create(){

        $roles = map_options(Role::class, 'id', 'name');
        // $subroles = map_options(SubRole::class, 'id', 'description');

        $excludedSubRoles = User::pluck('sub_role')->where('status', '!=', 2)->toArray();

        $subroles = SubRole::whereNotIn('id', $excludedSubRoles)->get()->map(function ($subrole) {
            return [
                'id' => $subrole->id,
                'name' => $subrole->description,
            ];
        });

        return view('pages.hr.users.create', compact('roles', 'subroles'));

    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'role' => 'required|exists:roles,id',
            'subrole' => 'required|exists:sub_roles,id',
            'emailaddress' => 'required|email|unique:users,email|max:255'
        ]);

        if ($validator->fails()) {
            return back()->with('error', implode('<br>', $validator->errors()->all()));
        }

        $randomPassword = Str::random(8);
        $reg = User::create([
            'name' => $request->name,
            'email' => $request->emailaddress,
            'password' => Hash::make($randomPassword),
            'role_id' => $request->role,
            'sub_role' => $request->subrole,
            'status' => 1
            
        ]);
        $email = $request->emailaddress;
        $subject = "Welcome to Our Service - Your Login Credentials";
        $body_messge = "
            <p>Dear $request->name,</p>
            <p>We are pleased to inform you that your account has been successfully created by your HR team.</p>
            <p>Below are your account details:</p>
            <ul>
                <li><strong>Email:</strong> $email</li>
                <li><strong>Username:</strong> $request->name</li>
                <li><strong>Password:</strong> $randomPassword</li>
            </ul>
            <p>You can now log in to your account using the provided credentials.</p>
            <p>If you did not request an account, please disregard this email.</p>
            <p>Best regards,</p>
            <p>The WBEO Team</p>
            ";

        if($reg){

            $SendMailController = new SendMailController();
            try{
                $SendMailController->send_email($email,$subject,$body_messge);
            }catch(\Exception $e){
                return response()->json(['error','error']);
            }
           
        }

        return back()->with('success', 'Sucessfully Added User!');
    }

    public function details($id)
    {
        $userDetails = User::find($id);

        $roles = map_options(Role::class, 'id', 'name');
        $subroles = map_options(SubRole::class, 'id', 'description');

        if ($userDetails) {
            return view('pages.hr.users.edit', compact('userDetails', 'roles', 'subroles'));
        }

        return redirect()->back()->with('error', 'User doesn\'t exist');
    }

    public function update(Request $request, $id) {

        $user = User::find($id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role,
            'sub_role' => $request->subrole
        ]);

        return redirect()->back()->with('success', 'User updated successfully');
    }

    public function disable($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User doesn\'t exist');
        }

        $user->update([
            'status' => 2,
        ]);

        return redirect()->route('users.index')->with('success', 'User account successfully disabled.');
    }
}