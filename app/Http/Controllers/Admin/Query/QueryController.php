<?php

namespace App\Http\Controllers\Admin\Query;

use App\Models\Query;
use App\Models\Destination;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QueryController extends Controller
{
    // Display a list of queries
    public function index(Request $request)
    {
        $perPage = $request->perPage ?? 15;
        $queries = Query::query();
        if (!empty($request->search)) {
            $queries->where('name', 'LIKE', "%{$request->search}%");
        }
        if (!empty($request->sortColumn)) {
            $queries->orderBy($request->sortColumn, "{$request->sortDirection}");
        } else {
            $queries = $queries->latest('id');
        }
        $queries = $queries->paginate($perPage);
        if ($request->ajax()) {
            try {
                $datatable = view('admin.query.datatable', compact('queries'))->render();
                return response()->json([
                    'status' => '200',
                    'msg' => 'Data loaded',
                    'data' => $datatable,
                    'paginationInfo' => getPaginationInfo($queries)
                ], 200);
            } catch (\Throwable $th) {
                return response()->json([
                    'status' => '200',
                    'msg' => 'An error occured while fetchingd ata',
                    'eception' => $th->getMessage()
                ], 500);
            }
        }
        return view('admin.query.index', compact('queries'));
    }

    // Show the form for creating a new query
    public function create()
    {
        $destinations = Destination::all(); // Make sure each has `type` field
        return view('admin.query.create', compact('destinations'));
    }

    // Store a new query
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
        ]);

        Query::create([
            'uuid' => Str::uuid(),
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'city' => $request->city,
            'attribute' => $request->attribute,
        ]);

        return redirect()->route('admin.query.index')->with('success', 'Query submitted successfully.');
    }

    // Display a single query
    public function show(Query $query)
    {
        return view('admin.query.show', compact('query'));
    }

    // Show the form to edit a query
    public function edit(Query $query)
    {
        return view('admin.query.edit', compact('query'));
    }

    // Update an existing query
    public function update(Request $request, Query $query)
    {
        $request->validate([
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'attribute' => 'nullable|json',
        ]);

        $query->update($request->all());

        return redirect()->route('admin.query.index')->with('success', 'Query updated successfully.');
    }

    // Delete a query
    public function destroy($uuid)
    {
        $query = Query::where('uuid', $uuid)->firstOrFail();

        if ($query->delete()) {
            return redirect()->route('admin.query.index')->with('success', 'Query deleted successfully.');
        }
        return redirect()->route('admin.query.index')->with('error', 'Something went wrong.');
    }
}
