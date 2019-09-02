<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //login
    public function login(Request $request) {

        $credentials = $request->only('email', 'password');
        if ($token = Auth::guard()->attempt($credentials)) {
            $credentials['verified'] = 1;
            if ($token = Auth::guard()->attempt($credentials)) {
                return response()->json(['status' => 'success', $token], 200)->header('Authorization', 'Bearer '. $token);
            } else {
                return response()->json(['status' => 'error', 'errors'=>  [ 'verify' => ['Please Verify Your email.']]], 422);
            }
        }

        return response()->json(['status' => 'error', 'errors'=>  [ 'login' => ['Your Email or Password is wrong.']]], 422);
    }

    //logout
    public function logout() {
        Auth::guard()->logout();

        return response()->json([
            'status' => 'success',
            'msg' => 'Logged out Successfully.'
        ], 200);
    }
}
