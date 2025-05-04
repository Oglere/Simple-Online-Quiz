<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class OtpController extends Controller
{
    public function verify(Request $request) {
        $request->validate(['email' => 'required|email']);
        $email = $request->input('email');

        $user = User::where('email', '=', $email)->first();

        if ($user){
            session([
                'recovery_email' => $email,
                'timer' => Carbon::now()->addMinutes(5),
            ]);

            $otp = rand(100000, 999999);

            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = env('MAIL_USERNAME');
                $mail->Password = env('MAIL_PASSWORD');
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;
    
                $mail->setFrom(env('MAIL_USERNAME'), 'OTP Verification');
                $mail->addAddress($email);
                $mail->Subject = 'Your OTP Code';
                $mail->isHTML(true);
                $mail->Body = "<p>Your OTP code is: <b>$otp</b>. It expires in 5 minutes.</p>";
    
                $mail->send();
    
                DB::table('users')
                    ->where('email', $email)
                    ->update([
                        'otp' => $otp,
                        'expire' => Carbon::now()->addMinutes(5),
                    ]);

                return redirect('/go/recovery/verify')->with('atay', $email);
            } catch (Exception $e) {
                return back()->withErrors(['email' => 'Could not send email. Error: ' . $mail->ErrorInfo]);
            }
        } else {
            return back()->withErrors(['email' => $email . ' was not found in the system.']);
        }
        
    }

    public function recovery() {
        if (!session()->has('recovery_email')) {
            abort(403, 'Unauthorized access.');
        }

        return view('go.verify_otp');
    }

    public function otp(Request $request) {
        

        $request->validate([
            'otp' => 'required|numeric',
        ]);
    
        $email = session('recovery_email');
        $inputOtp = $request->input('otp');
        $storedOtp = DB::table('users')->where('email', $email)->value('otp');
        $expiration = session('timer');
    
        if (!$email || !$storedOtp || !$expiration) {
            return back()->withErrors(['otp' => 'Session expired. Please request a new OTP.']);
        }
    
        // Check expiry
        if (Carbon::now()->gt(Carbon::parse($expiration))) {
            return back()->withErrors(['otp1' => 'OTP expired. Please request a new one here.']);
        }
    
        // Check if OTP matches
        if ($inputOtp != $storedOtp) {
            return back()->withErrors(['otp' => 'Invalid OTP. Please try again.']);
        }
    
        // OTP is valid
        Session::forget(['otp', 'timer']); 

        $user = User::where('email', '=', $email)->where('status', 'Active')->first();
    
        if ($user) {
            Auth::login($user);
            $request->session()->regenerate();
    
            return match ($user->role) {
                'Admin' => redirect('admin/edit'),
                'Teacher' => redirect('teacher/edit'),
                'Student' => redirect('student/edit'),
                default => back()->withErrors(['Invalid role.'])
            };
            
        }
    }
}
