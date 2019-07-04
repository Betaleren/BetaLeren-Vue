<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Validator;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {

        $status = 401;
        $response = ['error' => 'Unauthorised'];
        if (Auth::attempt($request->only(['email', 'password']))) {
            $status = 200;
            $response = [
                $user = 'user' => Auth::user(),
                $token = 'token' => Auth::user()->createToken('beta')->accessToken,
            ];
        }

        return response()->json($response, $status);
    }
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|max:50',
            'lastname' => 'required|max:50',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'c_password' => 'required|same:password',
        ]);
        if($validator->fails()){
            return response()->json(['error' => $validator->errors()], 401);
        }
        $data = $request->only(['firstname', 'lastname', 'email' , 'password']);
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        $user->is_admin = 0;
        return Response()->json([
            'user' => $user,
            'token' => $user->createToken('Forum')->accessToken,
        ]);
    }
}
