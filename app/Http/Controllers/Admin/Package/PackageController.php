<?php

namespace App\Http\Controllers\Admin\Package;

use App\Models\Package;
use App\Models\PackageImage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Support\Facades\Validator;

class PackageController extends Controller
{

    protected $basePath = 'uploads/packages/';

    /**
     * Display a package of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->perPage ?? 15;
        $packages = Package::query();
        if (!empty($request->search)) {
            $packages->where('name', 'LIKE', "%{$request->search}%");
        }
        if (!empty($request->sortColumn)) {
            $packages->orderBy($request->sortColumn, "{$request->sortDirection}");
        } else {
            $packages = $packages->latest('id');
        }
        $packages = $packages->paginate($perPage);
        if ($request->ajax()) {
            try {
                $datatable = view('admin.package.datatable', compact('packages'))->render();
                return response()->json([
                    'status' => '200',
                    'msg' => 'Data loaded',
                    'data' => $datatable,
                    'paginationInfo' => getPaginationInfo($packages)
                ], 200);
            } catch (\Throwable $th) {
                return response()->json([
                    'status' => '200',
                    'msg' => 'An error occured while fetching data',
                    'eception' => $th->getMessage()
                ], 500);
            }
        }
        return view('admin.package.index', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Fetch Destinations for the dropdown
        $destinations = Destination::all();
        return view('admin.package.create', compact('destinations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make(
            $request->all(),
            [
                'destination_id' => 'required|exists:destinations,id',
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric',
                'duration_days' => 'required|numeric',
                'duration_nights' => 'required|numeric',
                // 'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'images' => 'nullable|array',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',

            ]
        );
        if ($validator->fails()) {
            dd($validator->errors()->all());
        }
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = [
            'uuid' => Str::uuid(),
            'destination_id' => $request->destination_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'duration_days' => $request->duration_days,
            'duration_nights' => $request->duration_nights,
        ];

        if (!file_exists(public_path($this->basePath))) {
            // return $this->basePath.$request->title;
            mkdir(public_path($this->basePath), 0777, true);
        }

        $filename = "package_" . time() . '.' . $request->image->extension();
        $request->image->move(public_path($this->basePath), $filename);
        $data['image'] = $this->basePath . $filename;

        if ($created = Package::create($data)) {
            return redirect()->route('admin.package.index')->with('success', 'Package created successfully!');
        }

        return back()->with('failure', 'Something went wrong');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $package = Package::with('destination')->where('uuid', $uuid)->firstOrFail();
        return view('admin.package.show', compact('package'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $package = Package::where('uuid', $uuid)->firstOrFail();
        $destinations = Destination::all();
        return view('admin.package.edit', compact('package', 'destinations'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {
        // Validate the request
        $validator = Validator::make(
            $request->all(),
            [
                'destination_id' => 'required|exists:destinations,id',
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric',
                'duration_days' => 'required|numeric',
                'duration_nights' => 'required|numeric',
                'images' => 'nullable|array',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]
        );
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $package = Package::where('uuid',$uuid)->first();

        $data = [
            'destination_id' => $request->destination_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'duration_days' => $request->duration_days,
            'duration_nights' => $request->duration_nights,
        ];
        if ($request->hasFile('image')) {
            if (!file_exists(public_path($this->basePath))) {
                mkdir(public_path($this->basePath), 0777, true);
            }

            // Delete old image if exists
            if ($package->image && file_exists(public_path($package->image))) {
                unlink(public_path($package->image));
            }

            $filename = "package_" . time() . '.' . $request->image->extension();
            $request->image->move(public_path($this->basePath), $filename);
            $data['image'] = $this->basePath . $filename;
        }

        // return $data;

        if ($package->update($data)) {
            return redirect()->route('admin.package.index')->with('success', 'Package updated successfully!');
        }

        return back()->with('error', 'Something went wrong');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        $package = Package::where('uuid', $uuid)->firstOrFail();
        // Delete the package record
        if($package->delete()){
            return redirect()->route('admin.package.index')->with('success', 'Package deleted successfully!');
        }

        return redirect()->route('admin.package.index')->with('error', 'Something went wrong');

    }


    public function displayPackageToggle(Request $request)
    {
        $package = Package::where('uuid', $request->uuid)->firstOrFail();
        $newStatus = !$package->status;
        $package->update(['status' => $newStatus]);

        return response()->json([
            'success' => true,
            'status' => $newStatus
        ]);
    }

    public function toggleFeatured(Request $request)
    {
        $package = Package::where('uuid', $request->uuid)->firstOrFail();
        $newStatus = !$package->is_featured;
        $package->update(['is_featured' => $newStatus]);

        return response()->json([
            'success' => true,
            'status' => $newStatus
        ]);
    }
}
