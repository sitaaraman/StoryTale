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

    public function show($slug)
    {
        $puser = Puser::where('slug', $slug)->firstOrFail();
        return view('pusers.show', compact('puser'));
    }
    public function edit($slug)
    {
        $puser = Puser::where('slug', $slug)->firstOrFail();
        return view('pusers.edit', compact('puser'));
    }
    public function update(Request $request, $slug)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'gender' => 'required|in:male,female,other',
            'dateofbirth' => 'nullable|date',
            'phone_number' => 'required|string|max:15',
            'profile' => 'nullable|image|max:2048',
            'password' => 'required|string|min:4|confirmed',
        ]);

        $puser = Puser::where('slug', $slug)->firstOrFail();
        $puserData = $request->only(['fullname', 'email', 'gender', 'dateofbirth', 'phone_number', 'password']);
        // $puser->fullname = $request->fullname;
        // $puser->email = $request->email;
        // $puser->gender = $request->gender;
        // $puser->dateofbirth = $request->dateofbirth;
        // $puser->phone_number = $request->phone_number;
        // $puser->password = $request->password; // Retain existing password
        $puser->slug = \Str::slug($request->fullname, '-');
        // Handle profile upload
        if ($request->hasFile('profile')) {
            $profile = $request->file('profile');
            $profileName = time() . '_' . $request->file('profile')->getClientOriginalName();
            $profile->move(public_path('uploads/profiles/'), $profileName);
            // $puser->profile = $profileName;
            $puserData['profile'] = $profileName;
        }
        $puser->update($puserData);
        return redirect()->route('pusers.show', $puser->slug)->with('success', 'Profile updated successfully.');
    }

    public function destroy($slug)
    {
        $puser = Puser::where('slug', $slug)->firstOrFail();
        $puser->delete();
        return redirect()->route('pusers.index')->with('success', 'User deleted successfully.');
    }
}
