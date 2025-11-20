<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Puser;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;
use Carbon\Carbon;

class PuserController extends Controller
{
    public function index()
    {
        return view('pusers.index');
    }

    public function create()
    {
        return view('pusers.create');
    }   
    public function store(Request $request)
    {
        // if(!session()->has('puser')){
        //     return redirect()->route('pusers.login')->with('error', 'You must be logged in to create a post.');
        // }
        $request->validate([
            'fullname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:pusers,username',
            'email' => 'required|email|max:255',
            'gender' => 'required|in:male,female,other',
            'dateofbirth' => 'nullable|date',
            'phone_number' => 'required|string|max:15',
            'profile' => 'nullable|image|max:2048',
            'password' => 'required|string|min:4|confirmed',
        ]);

        $puser = $request->all();

         // Handle profile upload

        if ($request->hasFile('profile')) {
            $profile = $request->file('profile');
            $profileName = time() . '_' . $request->file('profile')->getClientOriginalName();
            // $profilePath = $request->file('profile')->storeAs('profiles', $profileName, 'public'); ->store('profiles', 'public');if($file)
            $profile->move(public_path('uploads/profiles/'), $profileName);
            $puser['profile'] = $profileName;
        } else {
            $profileName = null;
        }
        $puser['slug'] = \Str::slug($request->fullname, '-');

        session(['pending_puser' => $puser]);
        // dd($puser);

        $otp = rand(100000, 999999);
        session(['otp' => $otp ,'otp_expires' => now()->addMinutes(5)]);
        
        $mailOtpSend = [
            'title' => 'Email Verification OTP',
            'username' => $puser['username'],
            'otp' => $otp,
        ];
        // $puserData = session('pending_puser');

        Mail::to($puser['email'])->send(new OtpMail($mailOtpSend));

        return redirect()->route('otp.create')->with('success', 'Please verify your email to complete registration.');
    }

    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        //
    }
    public function update(Request $request, $id)
    {

    }
    public function destroy($id)
    {
        //
    }
}
