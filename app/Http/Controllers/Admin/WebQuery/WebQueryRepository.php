<?php

namespace App\Http\Controllers\Admin\WebQuery;


use Throwable;
use App\Models\WebQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class WebQueryRepository
{
    protected $user;
    public function __construct()
    {
        $this->user = Auth::guard('admin')->user();
    }
    // Managing Customer

    public function buildDataTable(Request $request)
    {
        $row = WebQuery::orderBy('id', 'desc')->get();

        return DataTables::of($row)

            ->editColumn('created_at', function ($row) {
                return $row->updated_at->format('Y-m-d h:i A');
            })
            ->addColumn('actions', function ($row) {
                $status = $row->status == 'read' ? 'ri-eye-line' : 'ri-eye-close-line';
                return '<div class="btn-group" id="socialactions" role="group">
                <button  data-url="' . route('admin.webquery.show', $row->id) .
                    '"  class="btn btn-info btn-sm actionHandler"  type="button" title ="View">
                        <i class="' . $status . '"></i></button>
                <button  data-action="delete" data-url="' . route('admin.webquery.destroy', $row->id) .
                    '"  class="btn btn-danger btn-sm actionHandler"  type="button" title="delete">
                        <i class="ri-delete-bin-line"></i></button>
                        </div>';
            })
            ->addIndexColumn()
            ->rawColumns(['updated_at', 'actions'])
            ->make(true);
    }
    public function getRow($id)
    {
        return WebQuery::find($id);
    }
    public function deleteRow($id)
    {
        $row = $this->getRow($id);
        if ($row) {
            try {
                // $this->ImgDel($row->demo_img);
                $deleted = $row->delete();
                if ($deleted)
                    return response()->json(['status' => '200', 'msg' => 'Deleted Successfully']);
                return response()->json(['status' => '500', 'msg' => 'Something Went Wrong']);
            } catch (Throwable $th) {
                Log::emergency('Exception occurred: ' . $th->getMessage());
                return response()->json(['status' => '500', 'msg' => $th->getMessage()]);
            }
        }
        abort(404);
    }

    public function changeStatus($request, $id)
    {
        $row = $this->getRow($id);
        if ($row) {
            try {
                if ($request->type == 'read' || $request->type == 'unread') {
                    $updated = $row->update(['status' => $request->type]);
                    if ($updated)
                        return response()->json(['status' => '200', 'msg' => 'Status Changed']);
                }
                return response()->json(['status' => '500', 'msg' => 'Something Went Wrong']);
            } catch (Throwable $th) {
                Log::emergency('Exception occurred: ' . $th->getMessage());
                return response()->json(['status' => '500', 'msg' => $th->getMessage()]);
            }
        }
        abort(404);
    }
}
