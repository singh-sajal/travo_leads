<?php

namespace App\Http\Controllers\Agent;

use App\Models\Agent;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Query;
use App\Models\Destination;
use App\Models\Package;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AgentController extends Controller
{
    protected $basePath = 'uploads/agents/';

    public function registerPage()
    {
        return view('agent.registration.form');
    }

    public function store(Request $request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:agents,email',
            'phone' => 'required|digits:10|unique:agents,phone',
            'password' => 'required|min:6|confirmed',
        ], [
            'name.required' => 'Full Name is required.',
            'email.required' => 'Email is required.',
            'email.email' => 'Enter a valid email address.',
            'email.unique' => 'This email is already registered.',
            'phone.required' => 'Mobile number is required.',
            'phone.digits' => 'Mobile number must be exactly 10 digits.',
            'phone.unique' => 'This mobile number is already registered.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 6 characters.',
            'password.confirmed' => 'Passwords do not match.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Store user
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'agent_id' => $this->generateUniqueAgentId(),
        ];

        $agent =  Agent::create($data);

        if ($agent) {
            session(['agent' => $agent]);
            return redirect()->route('agent.verification')->with(
                'success',
                'Account created successfully. Please verify your details.'
            );
        } else {
            return redirect()->back()->with('error', 'somthing went wrong ');
        }
    }

    public function verification_page(Request $request)
    {
        $agent  = session('agent');
        if (!$agent) {
            return redirect()->route('agent.login')->with('error', 'Session expired. Please register again.');
        }
        $details = Agent::where('email', $agent->email)->first();
        return view('agent.registration.verification', ['agent' => $details]);
    }


    public function generateUniqueAgentId()
    {
        do {
            $uniqueId = 'AG_' . strtoupper(Str::random(8)); // Generate a random 8-character string
        } while (Agent::where('agent_id', $uniqueId)->exists()); // Ensure uniqueness

        return $uniqueId;
    }

    public function verifyDetails(Request $request)
    {
        // Find the agent by email
        $agent = Agent::where('email', $request->email)->first();

        // If agent not found, return error
        if (!$agent) {
            return redirect()->back()->with('error', 'Agent not found.');
        }

        // Define validation rules
        $validator = Validator::make($request->all(), [
            'aadhaar_front' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'aadhaar_back' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'pan_card' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // If validation fails, return errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Define base path
        $basePath = public_path('uploads/agents/' . $agent->agent_id);

        // Create directory if not exists
        if (!file_exists($basePath)) {
            mkdir($basePath, 0777, true);
        }

        // Store Images in the agent's folder
        $aadhaarFrontPath = $request->file('aadhaar_front')->move($basePath, 'aadhaar_front.' . $request->file('aadhaar_front')->getClientOriginalExtension());
        $aadhaarBackPath = $request->file('aadhaar_back')->move($basePath, 'aadhaar_back.' . $request->file('aadhaar_back')->getClientOriginalExtension());
        $panCardPath = $request->file('pan_card')->move($basePath, 'pan_card.' . $request->file('pan_card')->getClientOriginalExtension());

        // Save image paths in the database
        $agent->aadhaar_front = 'uploads/agents/' . $agent->agent_id . '/aadhaar_front.' . $request->file('aadhaar_front')->getClientOriginalExtension();
        $agent->aadhaar_back = 'uploads/agents/' . $agent->agent_id . '/aadhaar_back.' . $request->file('aadhaar_back')->getClientOriginalExtension();
        $agent->pan_card = 'uploads/agents/' . $agent->agent_id . '/pan_card.' . $request->file('pan_card')->getClientOriginalExtension();

        if ($agent->save()) {
            return redirect()->route('agent.home')->with('success', 'Details verified and stored successfully.');
        } else {
            return redirect()->back()->with('failure', 'Details didn\'t stored successfully');
        }
    }

    public function home()
    {
        return view('agent.home');
    }

    public function myAccount()
    {
        return view('agent.myAccount');
    }

    public function analyticsAndReport()
    {
        return view('agent.analyticsAndReport');
    }

    public function companyInfo()
    {
        return view('agent.companyInfo');
    }

    public function storeCompanyInfo(Request $request)
    {
        $agent = Auth::guard('agent')->user();
        $agent = Agent::where('agent_id', $agent->agent_id)->first();

        // Validate input data
        $request->validate([
            'c_name' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'address' => 'required|string',
            'pincode' => 'required|numeric|digits:6',
            'gstin' => 'nullable|string|max:15',
        ]);

        // Get the authenticated agent using 'agent' guard


        if (!$agent) {
            return redirect()->route('agent.login')->withErrors(['error' => 'Unauthorized access. Please log in.']);
        }

        // Update the agent's company information
        $data = [
            'company_name' => $request->c_name,
            'state' => $request->state,
            'city' => $request->city,
            'address' => $request->address,
            'pincode' => $request->pincode,
            'company_id' => $request->gstin,
        ];

        if ($agent->update($data)) {
            return redirect()->route('agent.myAccount')->with('success', 'Company information updated successfully!');
        }

        return redirect()->route('agent.myAccount')->with('error', 'Company information updated successfully!');
    }

    public function personalDetails()
    {
        return view('agent.personalDetails');
    }



    public function supportPage(){
        return view('agent.support');
    }
}
