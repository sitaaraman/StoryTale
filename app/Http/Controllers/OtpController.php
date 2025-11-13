<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Puser;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;
use Carbon\Carbon;

class OtpController extends Controller
{
    
    public function sendOtp(Request $request)
    {
        $puserData = session('pending_puser');
        // Logic to send OTP to the user's email or phone number
        // You can use a package like Twilio for SMS or a mail service for email

        // For demonstration, we'll just simulate sending an OTP
        $otp = rand(100000, 999999);
        session(['otp' => $otp ,'otp_expires' => now()->addMinutes(1)]);

        $mailOtpSend = [
            'title' => 'Email Verification OTP',
            'username' => $puserData['username'],
            'otp' => $otp,
        ];

        // In a real application, send the OTP via email/SMS here
        Mail::to($puserData['email'])->send(new OtpMail($mailOtpSend));

        return redirect()->route('otp.verify')->with('success', 'OTP has been sent. Please verify.');
    }

    public function sendOtpForm()
    {
        return view('pusers.otp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        $storedOtp = session('otp');
        $otpExpires = session('otp_expires');

        if (!$storedOtp || !$otpExpires) {
        return redirect()->back()->with('error', 'No OTP found. Please request a new one.');
    }

        if (now()->greaterThan($otpExpires)) {
            return redirect()->back()->with('error', 'OTP has expired. Please request a new one.');
        }

        if ($request->otp == $storedOtp) {
            // OTP is correct, proceed with registration
            $puserData = session('pending_puser');

            // Create the user
            Puser::create($puserData);
            // Clear OTP and pending user data from session
            session()->forget(['otp', 'otp_expires', 'pending_puser']);
            return redirect()->route('pusers.index')->with('success', 'Registration successful!');
        } else {
            return redirect()->back()->with('error', 'Invalid OTP. Please try again.');
        }
    }

    public function resendOtp()
    {
        $puserData = session('pending_puser');

        if (!$puserData) {
            return redirect()->route('pusers.index')->with('error', 'No pending registration found.');
        }

        // Generate new OTP
        $otp = rand(100000, 999999);
        session([
            'otp' => $otp,
            'otp_expires' => now()->addMinutes(1)
        ]);

        // Prepare mail data
        $mailOtpSend = [
            'title' => 'Resend OTP Verification',
            'username' => $puserData['username'],
            'otp' => $otp,
        ];

        // Send OTP email
        Mail::to($puserData['email'])->send(new OtpMail($mailOtpSend));

        return redirect()->route('otp.verify')->with('success', 'A new OTP has been sent to your email.');
    }

}