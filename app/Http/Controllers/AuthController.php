<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\SendMailController;


class AuthController extends Controller
{

    public function proccess_login(Request $request){
      try{
     $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

         if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
    
            $user = Auth::user();

        //  dd($user);
            // Store user data in session
            session(['user_data' => $user]);
            // redirect to homepage after login
            // if($user->role_id == 3){
               
            // }
            switch($user->role_id){
                case 1:   return  redirect()->intended(route('users.index'));
                break;
                case 2:   return  redirect()->intended(route('official_dashboard'));
                break;
                case 3:   return  redirect()->intended(route('home'));
                break;
            }

           
          
        }
        return redirect()->back()->with('error', 'Invalid credentials');
    }catch(\Exception $e){
        return redirect()->back()->with('error', $e->getMessage());
    }

       
    }


    public function home()
    {
        return view('pages.employee.profile.index');
    }
    public function hr_dashboard()
    {
        return view('pages.hr.users.index');
    }
    public function official_dashboard()
    {
        return view('pages.official.request-clearance.index');
    }



    public function proccess_register(Request $request)
    {
        try{
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);


        $reg = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role_id' => 3,
            'status' => 1

        ]);
        $email = $request->email;
        $subject = "Welcome to Our Service - Registration Confirmation";
        $body_messge = "
            <p>Dear $request->name,</p>
            <p>Thank you for registering with us!</p>
            <p>Here are your account details:</p>
            <ul>
                <li><strong>Email:</strong> $email</li>
                <li><strong>Username:</strong> $request->name</li>
            </ul>
            <p>You can log in to your account using the credentials you provided during registration.</p>
            <p>If you did not register for an account, please ignore this email or contact our support team.</p>
            <p>Best regards,</p>
            <p>The WBEO Team</p>
            ";
       

        if($reg){
            $SendMailController = new SendMailController();
            try{
                $response = $SendMailController->send_email($email,$subject,$body_messge);
            }catch(\Exception $e){
                return response()->json(['error','error']);
            }

            return redirect()->back()->with('success', 'Successfully registered.');
        }else{
            return redirect()->back()->with('error', 'Registration failed');
        }
    }catch(\Exception $e){
        return redirect()->back()->with('error', 'Registration failed');
    }
      

    }

    public function logout(Request $request){

      
        Auth::logout();
         
        //remove alll session data
        $request->session()->invalidate();

        // generate the session token to protect against session fixation attacks
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Successfully logged out.');
    }
}
