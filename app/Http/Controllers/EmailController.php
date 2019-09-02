<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;

class EmailController
{

    //verify
    public static function verify($email, $name, $subject, $verification_code)
    {
        Mail::send('email.verify', ['name' => $name, 'verification_code' => $verification_code],
            function($mail) use ($email, $name, $subject){
                $mail->from(getenv('FROM_EMAIL_ADDRESS'), "verify@betaleren.nl");
                $mail->to($email, $name);
                $mail->subject($subject);
            });
    }


    //password recovery
    public static function recovery($email, $name, $subject, $recovery_code)
    {
        Mail::send('email.recovery', ['name' => $name, 'recovery_code' => $recovery_code],
            function($mail) use ($email, $name, $subject){
                $mail->from(getenv('FROM_EMAIL_ADDRESS'), "reset@betaleren.nl");
                $mail->to($email, $name);
                $mail->subject($subject);
            });
    }
}
