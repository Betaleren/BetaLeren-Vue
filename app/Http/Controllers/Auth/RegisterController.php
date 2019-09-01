<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Validator;


class RegisterController extends Controller
{
    //register
    public function register(Request $request) {
        $v = Validator::make($request->all(), [
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password'  => 'required|min:10|confirmed',
        ]);

        if ($v->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 422);
        }

        $first_name = ucfirst($request->first_name);
        $last_name = ucfirst($request->last_name);

        $user = new User;
        $user->first_name = $first_name;
        $user->last_name = $last_name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        $email = $request->email;
        $name = $request->first_name .' ' .$request->last_name;
        $subject = "Please verify your email address.";
        $verification_code = str_random(30);
        DB::table('users_verifications')->insert(['user_id'=>$user->id,'token'=>$verification_code]);

        EmailController::verify($email, $name, $subject, $verification_code);

        return response()->json(['status' => 'success'], 200);
    }
}
