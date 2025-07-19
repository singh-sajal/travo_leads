<?php

namespace App\Http\Controllers\Web\Home;

use App\Models\Query;
use App\Models\Policy;
use App\Models\Destination;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\CaptchaGenerator;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    use CaptchaGenerator;

    protected $contact = [
        'phone' => "7552582222",
        'email' => "demo@gmail.com",
        'address' => "96, IDPL, Rishikesh",
        'social_links' => [
            'facebook' => 'facebook.com',
            'instagram' => 'instagra.com',
            'youtube' => 'youtube.com',
            'website' => 'website.com'
        ]
    ];

    public function index()
    {
        $domesticDestinations = Destination::where('type', 'domestic')->where('status', 1)->where('is_featured', 1)->get();
        $internationalDestinations = Destination::where('type', 'international')->where('status', 1)->get();
        return view('web.index', compact('domesticDestinations', 'internationalDestinations'));
    }

    public function about()
    {
        return view('web.about');
    }

    public function contact()
    {
        $contact = $this->contact;
        return view('web.contact', compact('contact'));
    }

    public function package($uuid)
    {
        $destination = Destination::where('uuid', $uuid)->with('package')->first();
        // $packages = Package::where('destination_id',$destination->id)->get();
        return view('web.package', compact('destination'));
    }


    public function captcha()
    {
        return $this->generateCaptcha();
    }

    public function queryStore(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'phone' => 'required|numeric',
                'city' => 'required|string|max:255',
                'person' => 'required|numeric|min:1',
                'date' => 'required|date|after_or_equal:today',
                'package' => 'required|exists:packages,id',
                'captcha' => 'required|min:6|max:6'
            ],
            [
                'date.after_or_equal' => 'You cannot select a past date.',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if (session()->get('captchaText') != $request->captcha) {
            return back()->with('failure', 'Invalid captcha, Please try again');
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'pickup_location' => $request->city,
            'uuid' => Str::uuid(),
            'no_of_persons' => $request->person,
            'expected_date' => $request->date,
            'package_id' => $request->package,
        ];

        if($request->price >= 10000){
            $data['lead_value'] = 40;
        }
        else{
            $data['lead_value'] = 20;
        }

        // return $data;
        if (Query::create($data)) {
            return redirect()->back()->with('success', 'We will contact you soon...');
        }

        return redirect()->back()->with('failure', 'Something went wrong, please try again.');
    }


    public function privacyPolicy()
    {
        $contact = $this->contact;
        $policy = Policy::where('key', 'privacy')->first();
        return view('web.privacyPolicy', compact('contact', 'policy'));
    }

    public function shipping()
    {
        return view('web.shipping&delivery');
    }

    public function termsAndConditions()
    {
        return view('web.terms&conditions');
    }
}
