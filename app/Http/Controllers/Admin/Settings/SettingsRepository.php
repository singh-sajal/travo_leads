<?php

namespace App\Http\Controllers\Admin\Settings;

use Throwable;
use App\Models\Policy;
use App\Models\Setting;
use App\Traits\ImageUpload;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class SettingsRepository
{
    protected $user;
    use ImageUpload;
    protected $social_media = ['facebook', 'instagram', 'linkedin', 'youtube', 'twitter'];
    protected $base_path = 'uploads/settings/';
    // public function __construct()
    // {
    //     $this->user = Auth::guard('admin')->user();
    // }
    // Managing Customer

    public function buildDataTable(Request $request)
    {
        $row = Setting::orderBy('id', 'desc');


        return DataTables::of($row)
            ->editColumn('profile_pic', function ($row) {
                return '<img class="img-fluid avatar-sm" src="' .
                    asset($row->profile_pic ?? 'uploads/no_img_icon.jpg') . '"/>';
            })
            ->editColumn('updated_at', function ($row) {
                return $row->updated_at->format('g:i A , d, F Y');
            })
            // ->editColumn('business_location', function ($row) {
            //     if (!empty($row->business_location)) {
            //         $location = htmlspecialchars($row->business_location, ENT_QUOTES | ENT_HTML5) . 'target="_blank"';
            //         return '<a class="badge bg-success" href="' . $location . '" target="_blank">Link</a>';
            //     } else
            //         return '<span class="badge bg-danger">NA</span>';
            // })
            // ->editColumn('is_verified', function ($row) {
            //     $is_verified = '<span class="text-primary fs-18 toggler actionHandler" data-action="togglestatus"
            //     data-url="' . route('business.listing.toggleverification', ['id' => $row->id, 'type' => 'is_verified', 'status' => '1']) . '">
            //     <i class="ri-checkbox-circle-fill"></i>  </span>';
            //     if ($row->is_verified == '0')
            //         $is_verified = '<span class="text-danger fs-18  toggler actionHandler"  data-action="togglestatus"
            //     data-url="' . route('business.listing.toggleverification', ['id' => $row->id, 'type' => 'is_verified', 'status' => '0']) . '">
            //      <i class="ri-close-circle-fill"></i></span>';
            //     return $is_verified;
            // })
            ->editColumn('status', function ($row) {
                $status = '<span class="badge bg-success toggler actionHandler"
                data-action="togglestatus"
                data-url="' . route('admin.customer.togglestatus', ['id' => $row->id, 'status' => 'active']) . '">
                 Active</span>';
                if ($row->status == '0')
                    $status = '<span class="badge bg-danger toggler actionHandler"
                data-action="togglestatus"
                data-url="' . route('admin.customer.togglestatus', ['id' => $row->id, 'status' => 'inactive']) . '">
                 Inactive</span>';
                return $status;
            })

            // <a class="btn btn-sm btn-primary"
            //                 href="{{ route('business.listing.create') }}">Add New</a>
            ->addColumn('actions', function ($row) {
                return '<div class="btn-group" id="socialactions" role="group">
                <a  href="' . route('admin.customer.show', $row->id) .
                    '"  class="btn btn-info btn-sm ">
                        <i class="ri-eye-line"></i></a>
                <a href="' . route('admin.customer.edit', $row->id) .
                    '"  class="btn btn-primary btn-sm ">
                        <i class="ri-edit-box-line"></i></a>
                <button  data-action="delete" data-url="' . route('admin.customer.destroy', $row->id) .
                    '"  class="btn btn-danger btn-sm actionHandler"  type="button">
                        <i class="ri-delete-bin-line"></i></button>
                        </div>';
            })
            ->addIndexColumn()
            ->rawColumns(['profile_pic', 'is_login_allow', 'status', 'updated_at', 'actions'])
            ->make(true);
    }

    public function getSetting($id)
    {
        // return Customer::with('images')->find($id);
        return Setting::find($id);
    }
    public function createSetting(Request $request)
    {
        try {
            $messages = [];
            // if ($request->has('type')) {
            $rules = [
                'icon_code' => 'required|string',
                'social_link' => 'required|string',
                'type' => 'required|string',
            ];
            // }

            $validated = Validator::make($request->all(), $rules, $messages);

            if ($validated->fails()) {
                return response()->json(['status' => '400', 'errors' => $validated->errors()]);
            }

            $data = [
                'key' => $request->icon_code,
                'slug' =>  Str::slug($request->icon_code),
                'common_key' => $request->type,
                'value' => $request->social_link,
            ];

            $url = route('admin.settings.index');
            $created = Setting::create($data);
            if ($created) {
                return response()->json(['status' => '200', 'msg' => 'Created Successfully', 'redirect' => $url]);
            }
            return response()->json(['status' => '500', 'msg' => 'Something Went Wrong']);
        } catch (Throwable $th) {
            Log::emergency('Exception occurred: ' . $th->getMessage());
            return response()->json(['status' => '500', 'msg' => $th->getMessage()]);
        }
        abort(404);
    }
    public function updateSetting(Request $request, $id)
    {
        if ($request->has('map')){
            $setting=Policy::where('id',$id)->first();
        }else{
            $setting = $this->getSetting($id);
        }
        if ($setting) {
            try {
                $messages = [];
                if ($request->has('phone')) {
                    $rules = ['phone' => 'required|digits:10'];
                    $data = ['value' => $request->phone];
                } elseif ($request->has('email')) {
                    $rules = ['email' => 'required|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'];
                    $data = ['value' => $request->email];
                } elseif ($request->has('whatsapp')) {
                    $rules = ['whatsapp' => 'required|digits:10'];
                    $data = ['value' => $request->whatsapp];
                } elseif ($request->has('address')) {
                    $rules = ['address' => 'required|min:5|max:250'];
                    $data = ['value' => $request->address];
                } elseif ($request->has('map')) {
                    $rules = ['map' => 'required|min:5|max:1500'];
                    $data = ['description' => $request->map];
                } elseif ($request->has('social_link')) {
                    $rules = ['social_link' => 'required|min:5|max:250'];
                    $data = ['value' => $request->social_link];
                } elseif ($request->has('logo')) {
                    $rules = ['logo' => 'required|file|mimes:png,jpg,jpeg,svg|max:2048'];
                } elseif ($request->has('fevicon')) {
                    $rules = ['fevicon' => 'required|file|mimes:png,jpg,jpeg|max:2048'];
                }
                elseif ($request->has('app')) {
                    $rules = ['app' => 'required|min:5|max:250'];
                    $data = ['value' => $request->app];
                }
                elseif ($request->has('del_app')) {
                    $rules = ['del_app' => 'required|min:5|max:250'];
                    $data = ['value' => $request->del_app];
                }
                elseif ($request->has('video_url')) {
                    $rules = ['video_url' => 'required|min:5|max:250'];
                    $data = ['value' => $request->video_url];
                }


                $validated = Validator::make($request->all(), $rules, $messages);

                if ($validated->fails()) {
                    return response()->json(['status' => '400', 'errors' => $validated->errors()]);
                }
                if ($request->hasFile('logo')) {
                    $data['value'] = $this->Crop($request->logo, 150, 42, $this->base_path) ?? null;
                    $this->ImgDel($setting->value);
                } elseif ($request->hasFile('fevicon')) {
                    $data['value'] = $this->Crop($request->fevicon, 48, 48, $this->base_path) ?? null;
                    $this->ImgDel($setting->value);
                }

                $url = route('admin.settings.index');
                $updated = $setting->update($data);
                if ($updated) {
                    return response()->json(['status' => '200', 'msg' => 'Updated Successfully', 'redirect' => $url]);
                }
                return response()->json(['status' => '500', 'msg' => 'Something Went Wrong']);
            } catch (Throwable $th) {
                Log::emergency('Exception occurred: ' . $th->getMessage());
                return response()->json(['status' => '500', 'msg' => $th->getMessage(),
            'exception'=>$th->getTrace()
            ]);
            }
        }
        abort(404);
    }

    public function deleteSetting($id)
    {
        $row = $this->getSetting($id);
        if ($row) {
            try {
                // $this->ImgDel($customer->profile_pic);
                $deleted = $row->delete();
                $url = route('admin.settings.index');
                if ($deleted)
                    return response()->json(['status' => '200', 'msg' => 'Deleted Successfully', 'redirect' => $url]);
                return response()->json(['status' => '500', 'msg' => 'Something Went Wrong']);
            } catch (Throwable $th) {
                Log::emergency('Exception occurred: ' . $th->getMessage());
                return response()->json(['status' => '500', 'msg' => $th->getMessage()]);
            }
        }
        abort(404);
    }
}
