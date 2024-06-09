<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function openlogin(){
        return view('user.login');
    }

    public function login(Request $request){
        $email   = $request->email;
        $password = $request->password;
        // $password = Hash::make($password);

        if(Auth::attempt(['email' => $email, 'password' => $password])){
            return redirect('/');
        }
        else{
            return redirect('/login');
        }


    }

    public function openRegister(){
        return view('user.register');
    }

    public function register(Request $request){
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $thumbnail = $request->thumbnail;
        if($thumbnail){
            $profileImage1 = rand(1,99999).'-'.$thumbnail->getClientOriginalName();
            $path = 'Image';
            $thumbnail->move($path,$profileImage1);
        }

       

        try {
            User::create([
                'name'=>$name,
                'email'=>$email,
                'password'=>Hash::make($password),
                'thumbnail'=>$profileImage1
            ]);
            return redirect('/login');
        } catch (Exception $e) {
            return redirect('/register');
        }
        
    }

    public function openlogout(){
        return view('students.logout');
    }
    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
