<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ResetPasswordController extends Controller
{
    //password change
    public function change(Request $request)
    {
        $check = DB::table('users_password_resets')->where('token', $request->recovery_code)->first();
        if (!is_null($check)) {
            $v = Validator::make($request->all(), [
                'password'  => 'required|min:10|confirmed',
            ]);

            if ($v->fails()) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $v->errors()
                ], 422);
            }

            $user = User::where('id', $check->user_id)->first();
            $user->password = bcrypt($request->password);
            $user->save();
            DB::table('users_password_resets')->where('user_id', $user->id)->delete();

            return response()->json(['status' => 'success', 'message' => ['changed' => ['Your password is being changed']]], 201);
        }

        return response()->json(['status' => 'error', 'errors' => ['recovery_code'=> ['Recovery code is invalid.']]], 422);
    }
}
