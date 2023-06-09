<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin(){
        return view('frontend.auth.showLogin');
    }
    public function showRegister(){
        return view('frontend.auth.showRegister');
    }
    public function postLogin(Request $request){
        // check_user
        $user = User::where('email',$request->email)->first();
        if(!$user){
            return redirect()->back()->with('error','User Not Found');
        }

        // check_password
        $password = Hash::check($request->password, $user->password);
        if(!$password){
            return redirect()->back()->with('error','Wrong Password');
        }

        auth()->login($user);
        return redirect('/')->with('success','Welcome '.$user->name);
    }
    public function postRegister(Request $request){
        // return $request->all();
        $request->validate(
            [
                'name' => 'required|min:3',
                'email' => 'required|email',
                'phone' => 'required',
                'password' => 'required|min:6',
                'com_password' => 'required|min:6',
                'image' => 'required|mimes:jpg,jpeg,png,webp|max:2048',
            ],
            [
                'com_password.required' => 'Please fill the confirm password'
            ]);
    
            // email-already-validate
            $email = User::where('email',$request->email)->first();
            if($email){
                return redirect()->back()->with('error','Email Already Exists.');
            }
    
            // phone-alerady-validate
            $phone = User::where('phone',$request->phone)->first();
            if($phone){
                return redirect()->back()->with('error','Phone Number Already Exists.');
            }
    
            // password-confirm
            if($request->password !== $request->com_password){
                return redirect()->back()->with('error','Confirm Password Doesnot Match');
            }
    
            // image-upload
            $file = $request->file('image');
            $file_name = uniqid() . $file->getClientOriginalName();
            $file->move(public_path('/images'),$file_name);

            // user-create
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'image' => $file_name,
            ]);

            auth()->login($user);
            return redirect('/')->with('success','Welcome '.$user->name);
    }

    public function logout(){
        auth()->logout();
        return redirect('/login');
    }
}
