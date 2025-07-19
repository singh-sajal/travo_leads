<?php

namespace App\Http\Controllers\Agent;

use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;



class AuthController extends Controller
{
    public function loginPage()
    {
        return view('agent.loginPage');
    }

    public function verifyLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'nullable|digits:10',
            'email' => 'nullable|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->has('phone') && $request->phone) {
            $agent = Agent::where('phone', $request->phone)->first();
        } elseif ($request->has('email') && $request->email) {
            $agent = Agent::where('email', $request->email)->first();
        } else {
            return back()->withErrors(['login' => 'Invalid login credentials.'])->withInput();
        }

        if (!$agent) {
            return redirect()->back()->withInput()->withErrors(['login' => 'User not found.']);
        }

        if (!Hash::check($request->password, $agent->password)) {
            return redirect()->back()->withInput()->withErrors(['password' => 'Incorrect password.']);
        }

        Auth::guard('agent')->login($agent);


        return redirect()->route('agent.home')->with('success', 'Login successful');
    }

    public function logout()
    {
        Auth::guard('agent')->logout();
        return redirect()->route('agent.login');
    }

    public function changePassword()
    {
        return view('agent.changePassword');
    }

    public function updatePassword(Request $request)
    {
        // Validate input
        $request->validate([
            'password' => 'required|min:8|confirmed', // Ensures passwords match
        ]);

        // Get authenticated agent
        $agent = Auth::guard('agent')->user();

        if (!$agent) {
            return redirect()->back()->with('error', 'User not authenticated.');
        }

        // Update password
        $agent->password = Hash::make($request->password);
        if ($agent->save()) {

            return redirect()->back()->with('status', 'Password updated successfully!');
        }
        return redirect()->back()->with('status', 'Something went wrong!');
    }
}
