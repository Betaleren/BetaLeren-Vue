<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\EmailController;

class ForgotPasswordController extends Controller
{
    //password recovery
    public  function recovery(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json(['status' => 'error', 'errors' => ['email'=> ['Your email address was not found.']]], 422);
        }

        $already_code = DB::table('password_resets')->where('user_id', $user->id)->first();
        if ($already_code) {
            DB::table('password_resets')->where('user_id', $user->id)->delete();
        }

        $email = $user->email;
        $name = $user->first_name .' ' .$user->last_name;
        $subject = "Password reset.";
        $recovery_code = str_random(30);  //Generate recovery code
        DB::table('password_resets')->insert(['user_id'=>$user->id,'token'=>$recovery_code]);

        EmailController::recovery($email, $name, $subject, $recovery_code);

        return response()->json(['status' => 'success', 'message' => ['send'=> ['Password reset e-mail has been send.']]], 201);
    }
}
