<?php

namespace App\Http\Controllers\Agent;

use Throwable;
use App\Models\Agent;
use App\Models\Query;
use App\Models\Package;
use App\Models\Destination;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Validator;

class LeadController extends Controller
{
    public function buyLeads()
    {
        $agent = Auth::guard('agent')->user();

        // Step 1: Get query IDs of already bought leads
        $boughtLeadIds = Transaction::where('agent_id', $agent->id)
            ->whereNotNull('query_id')
            ->pluck('query_id')
            ->toArray();

        // Step 2: Get unbought leads, sorted by latest
        $leads = Query::with('package.destination')
            ->whereNotIn('id', $boughtLeadIds)
            ->orderBy('created_at', 'desc')
            ->get();

        // Step 3: Get pickup cities from remaining leads
        // $cities = $leads->pluck('pickup_location')->unique();

        return view('agent.buyLeads', compact('leads'));
    }

    public function myLeads()
    {
        $agent = Auth::guard('agent')->user();

        // Step 1: Get all bought query IDs by this agent
        $boughtQueryIds = Transaction::where('agent_id', $agent->id)
            ->whereNotNull('query_id')
            ->pluck('query_id')
            ->toArray();

        // Step 2: Get all the Query models corresponding to those IDs
        $leads = Query::with('package.destination')
            ->whereIn('id', $boughtQueryIds)
            ->orderBy('created_at', 'desc') // show latest bought leads first
            ->get();

        return view('agent.myLeads', compact('leads'));
    }

    // public function filterLeads(Request $request)
    // {
    //     $query = Query::with('package.destination');

    //     if ($request->filled('city')) {
    //         $query->where('pickup_location', 'LIKE', '%' . $request->city . '%');
    //     }

    //     if ($request->filled('type')) {
    //         $query->whereHas('package.destination', function ($q) use ($request) {
    //             $q->where('type', $request->type);
    //         });
    //     }

    //     if ($request->filled('start_date') || $request->filled('end_date')) {
    //         $startDate = $request->start_date ?: '1900-01-01';
    //         $endDate = $request->end_date ?: now()->addYears(10)->toDateString();

    //         $query->whereBetween('expected_date', [$startDate, $endDate]);
    //     }


    //     if ($request->filled('sort')) {
    //         switch ($request->sort) {
    //             case 'latest':
    //                 $query->orderBy('created_at', 'desc');
    //                 break;
    //             case 'oldest':
    //                 $query->orderBy('created_at', 'asc');
    //                 break;
    //             case 'high':
    //                 $query->orderBy('lead_value', 'desc');
    //                 break;
    //             case 'low':
    //                 $query->orderBy('lead_value', 'asc');
    //                 break;
    //         }
    //         $leads = $query->get();
    //     } else {
    //         $leads = $query->orderBy('created_at', 'desc')->get();
    //     }


    //     return view('agent.buyLeads', compact('leads'));
    // }

    public function filterLeads(Request $request)
    {
        $agent = Auth::guard('agent')->user();

        // Step 1: Get IDs of leads already bought by this agent
        $boughtLeadIds = Transaction::where('agent_id', $agent->id)
            ->whereNotNull('query_id')
            ->pluck('query_id')
            ->toArray();

        // Step 2: Start building the query with necessary relations and filter out bought leads
        $query = Query::with('package.destination')
            ->whereNotIn('id', $boughtLeadIds);

        // Step 3: Apply city filter
        if ($request->filled('city')) {
            $query->where('pickup_location', 'LIKE', '%' . $request->city . '%');
        }

        // Step 4: Apply type filter
        if ($request->filled('type')) {
            $query->whereHas('package.destination', function ($q) use ($request) {
                $q->where('type', $request->type);
            });
        }

        // Step 5: Apply date range filter
        if ($request->filled('start_date') || $request->filled('end_date')) {
            $startDate = $request->start_date ?: '1900-01-01';
            $endDate = $request->end_date ?: now()->addYears(10)->toDateString();

            $query->whereBetween('expected_date', [$startDate, $endDate]);
        }

        // Step 6: Sorting logic
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'latest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'oldest':
                    $query->orderBy('created_at', 'asc');
                    break;
                case 'high':
                    $query->orderBy('lead_value', 'desc');
                    break;
                case 'low':
                    $query->orderBy('lead_value', 'asc');
                    break;
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        // Step 7: Fetch the filtered leads
        $leads = $query->get();

        return view('agent.buyLeads', compact('leads'));
    }

    public function filterMyLeads(Request $request)
    {
        $agent = Auth::guard('agent')->user();

        // Step 1: Get all bought query IDs
        $boughtQueryIds = Transaction::where('agent_id', $agent->id)
            ->whereNotNull('query_id')
            ->pluck('query_id')
            ->toArray();

        // Step 2: Base query only on bought leads
        $query = Query::with('package.destination')
            ->whereIn('id', $boughtQueryIds);

        // Step 3: Apply filters
        if ($request->filled('city')) {
            $query->where('pickup_location', 'LIKE', '%' . $request->city . '%');
        }

        if ($request->filled('type')) {
            $query->whereHas('package.destination', function ($q) use ($request) {
                $q->where('type', $request->type);
            });
        }

        if ($request->filled('start_date') || $request->filled('end_date')) {
            $startDate = $request->start_date ?: '1900-01-01';
            $endDate = $request->end_date ?: now()->addYears(10)->toDateString();
            $query->whereBetween('expected_date', [$startDate, $endDate]);
        }

        // Step 4: Apply sorting
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'latest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'oldest':
                    $query->orderBy('created_at', 'asc');
                    break;
                case 'high':
                    $query->orderBy('lead_value', 'desc');
                    break;
                case 'low':
                    $query->orderBy('lead_value', 'asc');
                    break;
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        // Step 5: Get filtered leads and return to view
        $leads = $query->get();

        return view('agent.myLeads', compact('leads'));
    }



    // when buying a lead
    public function boughtLead(Request $request)
    {

        $validator = $request->validate([
            'lead_id' => 'required|integer',
            'lead_value' => 'required|numeric',
        ]);


        try {
            $agent = Auth::guard('agent')->user();


            $finalBalance = $this->getFinalBalance($agent->id);

            if ($finalBalance >= $request->lead_value) {

                $finalBalance = $finalBalance - $request->lead_value;

                $data = [
                    'agent_id' => $agent->id,
                    'transaction_type' => 'deducted',
                    'transaction_number' => $this->generateTransactionNumber($agent->agent_id),
                    'amount' => $request->lead_value,
                    'final_balance' => $finalBalance,
                    'query_id' => $request->lead_id,

                ];
                if (Transaction::create($data)) {

                    return response()->json(['success' => true, 'message' => 'Lead purchased successfully'], 200);
                }
            }
            return response()->json(['success' => false, 'message' => 'Lead not purchased successfully!'], 404);
        } catch (Throwable $th) {
            return response()->json(['status' => 500, 'exception' => $th->getMessage(), 'trace' => $th->getTrace()]);
        }
    }

    public function balance()
    {
        $agent = Auth::guard('agent')->user();
        return response()->json(['balance' => $this->getFinalBalance($agent->id)]);
    }

    public function getFinalBalance($id)
    {
        // Get the last transaction of the agent
        // $lastTransaction = Transaction::where('agent_id', $id)->latest();
        $lastTransaction = Transaction::where('agent_id', $id)
            ->orderBy('id', 'desc')
            ->first();

        // Get the last balance, default to 0 if no previous transaction
        $lastBalance = $lastTransaction ? (float) $lastTransaction->final_balance : 0;

        return $lastBalance;
    }

    function generateTransactionNumber($agentId)
    {
        return 'TXN-' . $agentId . '-' . strtoupper(uniqid());
    }

    public function updateFollowUp(Request $request, $id)
    {
        $lead = Query::findOrFail($id);
        $lead->follow_up_status = $request->status;
        $lead->save();

        return response()->json(['success' => true]);
    }
}
