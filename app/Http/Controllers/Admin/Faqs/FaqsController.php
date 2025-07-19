<?php

namespace App\Http\Controllers\Admin\Faqs;

use App\Models\Faqs;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class FaqsController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->perPage ?? 15;
        $faqs = Faqs::query();

        if (!empty($request->search)) {
            $faqs->where('question', 'LIKE', "%{$request->search}%");
        }

        if (!empty($request->sortColumn)) {
            $faqs->orderBy($request->sortColumn, $request->sortDirection ?? 'asc');
        } else {
            $faqs->latest('id');
        }

        $faqs = $faqs->paginate($perPage);

        if ($request->ajax()) {
            try {
                $datatable = view('admin.faqs.datatable', compact('faqs'))->render();
                return response()->json([
                    'status' => '200',
                    'msg' => 'Data loaded',
                    'data' => $datatable,
                    'paginationInfo' => getPaginationInfo($faqs)
                ], 200);
            } catch (\Throwable $th) {
                return response()->json([
                    'status' => '500',
                    'msg' => 'An error occurred while fetching data',
                    'exception' => $th->getMessage()
                ], 500);
            }
        }

        return view('admin.faqs.index', compact('faqs'));
    }

    public function create()
    {
        return view('admin.faqs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        $data = [
            'question' => $request->question,
            'answer' => $request->answer,
            'uuid' => Str::uuid(),
        ];

        if (Faqs::create($data)) {
            return redirect()->route('admin.faqs.index')->with('success', 'FAQ created successfully!');
        }
        return redirect()->back()->withInput()->withErrors($validated);
    }

    public function show($uuid)
    {
        $faq = Faqs::where('uuid', $uuid)->firstOrFail();
        return view('admin.faqs.show', compact('faq'));
    }

    public function edit($uuid)
    {
        $faq = Faqs::where('uuid', $uuid)->firstOrFail();
        return view('admin.faqs.edit', compact('faq'));
    }

    public function update(Request $request, $uuid)
    {
        $faq = Faqs::where('uuid', $uuid)->first();
        $validator = Validator::make($request->all(), [
            'question' => 'sometimes|string|max:250',
            'answer' => 'sometimes|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        $data = [
            'question' => $request->question,
            'answer' => $request->answer,
        ];

        if ($faq->update($data)) {
            return redirect()->route('admin.faqs.index')->with('success', 'FAQ updated successfully!');
        }
        return redirect()->route('admin.faqs.index')->with('error', 'Something went wrong!');
    }

    public function destroy($uuid)
    {
        $faq = Faqs::where('uuid', $uuid)->firstOrFail();
        $faq->delete();
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ deleted successfully!');
    }

    public function displayFaqsToggle(Request $request)
    {
        $faq = Faqs::where('uuid', $request->uuid)->firstOrFail();
        $newStatus = !$faq->status;
        $faq->update(['status' => $newStatus]);

        return response()->json([
            'success' => true,
            'status' => $newStatus
        ]);
    }


}
