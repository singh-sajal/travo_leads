<?php

namespace App\Http\Controllers\Admin\Banner;

use App\Models\Banner;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{

    protected $basePath = 'uploads/banners/';


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::all();
        return view('admin.banner.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'banner' => 'file|mimes:png,jpg,jpeg|max:2048',
            ],
            [
                'banner.mimes' => 'Image should be in png or jpg or jpeg format',
                'banner max' => 'Image should be less than 2MB'
            ]
        );
        //When validation fails.........
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }
        $data = ['uuid' => Str::uuid(),];
        $path = public_path($this->basePath);

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        if ($request->has('banner')) {
            $file = $request->file('banner');
            $filename = 'banner_' . time() . '.' . $file->extension();
            $file->move($path, $filename);
            $data['url'] = $this->basePath . "/" . $filename;
        }

        $created = Banner::create($data);
        if ($created) {
            return back()->with('success', 'Banner Uploaded successfully!');
        }

        return back()->with('failure', 'Something went wrong');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        $banner = Banner::where('uuid', $uuid)->first();

        // If banner not found, return error
        if (!$banner) {
            return back()->with('failure', 'Banner not found.');
        }

        // Get the file path
        $filePath = public_path($banner->url);
        // return $filePath;
        // Delete the file if it exists
        if ($filePath  && file_exists($filePath)) {
            unlink($filePath);
        }

        // Delete banner record
        if ($banner->delete()) {
            return back()->with('success', 'Banner deleted successfully!');
        }

        return back()->with('failure', 'Something went wrong while deleting.');
    }


    public function displayBannerToggle(Request $request)
    {
        $banner = Banner::where('uuid', $request->uuid)->firstOrFail();

        // Toggle status
        $newStatus = !$banner->status;
        $banner->update(['status' => $newStatus]);

        return response()->json([
            'success' => true,
            'status' => $newStatus
        ]);
    }
}
