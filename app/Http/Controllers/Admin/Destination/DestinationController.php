<?php

namespace App\Http\Controllers\Admin\Destination;

use App\Models\Destination;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Helpers\ToggleHelper;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class DestinationController extends Controller
{

    protected $basePath = 'uploads/destinations/';


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->perPage ?? 15;
        $destinations = Destination::query();
        if (!empty($request->search)) {
            $destinations->where('name', 'LIKE', "%{$request->search}%");
        }
        if (!empty($request->sortColumn)) {
            $destinations->orderBy($request->sortColumn, "{$request->sortDirection}");
        } else {
            $destinations = $destinations->latest('id');
        }
        $destinations = $destinations->paginate($perPage);
        if ($request->ajax()) {
            try {
                $datatable = view('admin.destination.datatable', compact('destinations'))->render();
                return response()->json([
                    'status' => '200',
                    'msg' => 'Data loaded',
                    'data' => $datatable,
                    'paginationInfo' => getPaginationInfo($destinations)
                ], 200);
            } catch (\Throwable $th) {
                return response()->json([
                    'status' => '200',
                    'msg' => 'An error occured while fetchingd ata',
                    'eception' => $th->getMessage()
                ], 500);
            }
        }
        return view('admin.destination.index', compact('destinations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.destination.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|unique:destinations,title',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'start_amount' => 'required|numeric',
            'type' => 'required|in:domestic,international',
        ]);

        // Upload Image
        if (!file_exists(public_path($this->basePath))) {
            // return $this->basePath.$request->title;
            mkdir(public_path($this->basePath), 0777, true);
        }

        $filename = "destination_" . time() . '.' . $request->image->extension();
        $request->image->move(public_path($this->basePath), $filename);
        $validated['image'] = $this->basePath . $filename;

        // Generate UUID
        $validated['uuid'] = Str::uuid();

        // Create Destination
        if (Destination::create($validated)) {
            return redirect()->route('admin.destination.index')->with('success', 'Destination added successfully!');
        }

        return redirect()->back()->withInput()->withErrors($validated);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $destination = Destination::where('uuid', $uuid)->firstOrFail();
        return view('admin.destination.show', compact('destination'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $destination = Destination::where('uuid', $uuid)->firstOrFail();
        return view('admin.destination.edit', compact('destination'));
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
        $destination = Destination::where('uuid', $uuid)->firstOrFail();

        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:30',
                Rule::unique('destinations', 'title')->ignore($destination->id),
            ],
            'image' => 'sometimes|image|mimes:jpg,jpeg,png|max:2048',
            'start_amount' => 'required|numeric',
            'type' => 'required|in:domestic,international',
            'status' => 'sometimes|boolean',
            'is_featured' => 'sometimes|boolean'
        ]);

        // Handle image update
        if ($request->hasFile('image')) {
            // Delete old image
            if (File::exists(public_path($destination->image))) {
                File::delete(public_path($destination->image));
            }

            // Upload new image
            $filename = "destination_" . time() . '.' . $request->image->extension();
            $request->image->move(public_path($this->basePath), $filename);
            $validated['image'] = $this->basePath . $filename;
        }

        $destination->update($validated);

        return redirect()->route('admin.destination.index')
            ->with('success', 'Destination updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        $destination = Destination::where('uuid', $uuid)->firstOrFail();

        // Delete associated image
        if (File::exists(public_path($destination->image))) {
            File::delete(public_path($destination->image));
        }

        $destination->delete();

        return redirect()->route('admin.destination.index')
            ->with('success', 'Destination deleted successfully!');
    }

    public function displayDestinationToggle(Request $request)
    {
        $destination = Destination::where('uuid', $request->uuid)->firstOrFail();
        $newStatus = !$destination->status;
        $destination->update(['status' => $newStatus]);

        return response()->json([
            'success' => true,
            'status' => $newStatus
        ]);
    }

    public function toggleFeatured(Request $request)
    {
        $destination = Destination::where('uuid', $request->uuid)->firstOrFail();
        $newStatus = !$destination->is_featured;
        $destination->update(['is_featured' => $newStatus]);

        return response()->json([
            'success' => true,
            'status' => $newStatus
        ]);
    }
}
