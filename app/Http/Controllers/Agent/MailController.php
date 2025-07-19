<?php

namespace App\Http\Controllers\Agent;

use App\Models\Agent;
use App\Mail\OTP_by_Email;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class MailController extends Controller
{
    public function sendOtp(Request $request)
    {
        $request->validate([
            'otp_type' => 'required|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|string'
        ]);

        $otp = mt_rand(100000, 999999);
        $type = $request->otp_type;

        // Store OTP in session
        session([
            'otp' => '' . $otp . '',
            'otp_expires_at' => now()->addMinutes(5),
            'email' => $request->email,
        ]);

        if ($type == 'email' && $request->email) {
            Mail::to($request->email)->send(new OTP_by_Email($otp));
        } elseif ($type == 'phone' && $request->phone) {
            // Send OTP via SMS (Implement Twilio or Firebase)
        } else {
            return response()->json(['message' => 'Invalid request'], 400);
        }

        return response()->json(['message' => 'OTP Sent']);
    }


    public function resendOtp(Request $request)
    {
        return $this->sendOtp($request);
    }

    public function verifyOtp(Request $request)
    {
        $userOtp = $request->otp;
        $storedOtp = session('otp');
        $expiresAt = session('otp_expires_at');

        if (!$storedOtp || now()->greaterThan($expiresAt)) {
            return response()->json(['status' => 'error', 'message' => 'OTP expired. Please request a new one.'], 400);
        }

        if ($userOtp == $storedOtp) {
            $agent = session()->get('agent');
            session()->forget(['otp', 'otp_expires_at']);

            // ✅ Correct update query
            // Agent::where('email', $email)->update(['email_verified' => '1']);

            $updated = Agent::where('email', $agent->email)->update(['email_verified' => 1]);

            if ($updated) {
                return response()->json(['status' => 'success', 'message' => 'OTP verified successfully!']);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Failed to update email verification.'], 400);
            }



            return response()->json(['status' => 'success', 'message' => 'OTP verified successfully!']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Invalid OTP. Try again.'], 400);
        }
    }

    public function checkVerificationStatus() {
        $agent = session()->get('agent');
        $agent = Agent::where('email',$agent->email)->first();

        return response()->json([
            'phone_verified' => $agent->phone_verified,
            'email_verified' => $agent->email_verified,
        ]);
    }
}
