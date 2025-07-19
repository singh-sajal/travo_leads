<?php
namespace App\Http\Controllers\Admin\Policy;

use App\Models\Policy;
use Throwable;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class PolicyRepository
{
    protected $user;
    // public function __construct()
    // {
    //     $this->user = Auth::guard('admin')->user();
    // }
    // Course Level Manage

    public function buildDataTable(Request $request)
    {
        // $row = Policy::query();
        $row = Policy::where('key','!=','map');

        return DataTables::of($row)
            ->editColumn('updated_at', function ($row) {
                return $row->updated_at->format('g:i A , d, F Y');
            })
            ->editColumn('description', function ($row) {
                return $row->description;
            })
            ->addColumn('actions', function ($row) {
                return '<div class="btn-group" id="socialactions" role="group">
                <button  data-url="' . route('admin.policy.show', $row->id) .
                    '"  class="btn btn-info btn-sm actionHandler"  type="button">
                        <i class="ri-eye-line"></i></button>
                <button  data-url="' . route('admin.policy.edit', $row->id) .
                    '"  class="btn btn-primary btn-sm actionHandler"  type="button">
                        <i class="ri-edit-box-line"></i></button>'
                // <button  data-action="delete" data-url="' .
                //     route('admin.policy.destroy', $row->id) .
                //     '"  class="btn btn-danger btn-sm actionHandler"  type="button">
                //         <i class="ri-delete-bin-line"></i></button>
                //         </div>'
                        ;
            })
            ->addIndexColumn()
            ->rawColumns(['key','description','updated_at', 'actions'])
            ->make(true);
    }
    public function getRow($id)
    {
        return Policy::find($id);
    }
    public function createRow(Request $request)
    {
        try {
            $data = [
                'description' => $request->description,
            ];
            $created = Policy::create($data);
            if ($created) {
                return response()->json(['status' => '200', 'msg' => 'Created Successfully']);
            }
            return response()->json(['status' => '500', 'msg' => 'Something Went Wrong']);
        } catch (Throwable $th) {
            Log::emergency('Exception occurred: ' . $th->getMessage());
            return response()->json(['status' => '500', 'msg' => $th->getMessage()]);
        }
    }
    public function updateRow(Request $request, $id)
    {
        $row = $this->getRow($id);
        if ($row) {
            try {
                $data = [
                    'description' => $request->description,
                ];
                // $updated = $row->update($data);
                // if ($updated) {
                //     return response()->json(['status' => '200', 'msg' => 'Updated Successfully']);
                // }
                // return response()->json(['status' => '500', 'msg' => 'Something Went Wrong']);

                // $url = route(''admin.course.show', $row->id);
                $url = route('admin.policy.index');
                $updated = $row->update($data);
                if ($updated) {
                    return response()->json(['status' => '200', 'msg' => 'Updated Successfully', 'redirect' => $url]);
                }
                return response()->json(['status' => '500', 'msg' => 'Something Went Wrong']);

            } catch (Throwable $th) {
                Log::emergency('Exception occurred: ' . $th->getMessage());
                return response()->json(['status' => '500', 'msg' => $th->getMessage()]);
            }
        }
        abort(404);
    }
    public function deleteRow($id)
    {
        $row = $this->getRow($id);
        if ($row) {
            try {
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

}
