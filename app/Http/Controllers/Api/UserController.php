<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
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
            $user = User::create([
                'name'=>$name,
                'email'=>$email,
                'password'=>Hash::make($password),
                'thumbnail'=>$profileImage1
            ]);
            $token = $user->createToken('token')->plainTextToken;
            return response([
                'message'=>'success',
                'data'=>$user,
                'token'=>$token
            ])->setStatusCode(201);
        } catch (Exception $e) {
            return response([
                'message'=>'cannot register',
            ])->setStatusCode(400);
        }
    }

    public function login(Request $request){
        $email   = $request->email;
        $password = $request->password;
        // $password = Hash::make($password);

        if(Auth::attempt(['email' => $email, 'password' => $password])){
            $user = Auth::user();
            $token = $user->createToken('token')->plainTextToken;
            return response([
                'message'=>'success',
                'data'=>$user,
                'token'=>$token
            ])->setStatusCode(200);
        }
        else{
            return response([
                'message'=>'cannot login',
            ])->setStatusCode(404);
        }


    }

}
