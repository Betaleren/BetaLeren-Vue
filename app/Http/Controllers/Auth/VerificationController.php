<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class VerificationController extends Controller
{
    //verify User
    public function verify($request)
    {
        $check = DB::table('users_verifications')->where('token',$request)->first();
        if(!is_null($check)){
            $user = User::find($check->user_id);
            if($user->verified == 1){
                return response()->json(['status'=> 'success', 'message'=> [ 'verified' => ['Account already verified.']]], 201);
            }

            $user->verified = 1;
            $user->email_verified_at = Carbon::now();
            $user->save();
            DB::table('users_verifications')->where('token',$request)->delete();

            return response()->json(['status'=> 'success', 'message'=> [ 'verified' => ['You have successfully verified your email address.']]], 201);
        }
        return response()->json(['status'=> 'error', 'errors'=> [ 'fail_verify' => ['Verification code is invalid.']]], 422);
    }
}
