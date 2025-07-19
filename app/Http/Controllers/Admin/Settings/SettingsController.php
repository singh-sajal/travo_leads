<?php
namespace App\Http\Controllers\Admin\Settings;

use App\Models\Policy;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\Settings\SettingsRequest;
use App\Http\Controllers\Admin\Settings\SettingsRepository;


class SettingsController extends Controller
{
    protected $repository;
    public function __construct(SettingsRepository $repository)
    {
        $this->repository = $repository;
    }
    public function index(Request $request)
    {
        // if (request()->ajax()) {
        //     $table = $this->repository->buildDataTable($request);
        //     return $table;
        // }
        $logo=Setting::where('key','logo')->first();
        $fevicon=Setting::where('key','fevicon')->first();
        $contacts=Setting::where('common_key','contact')->get();
        $social_links=Setting::where('common_key','social_link')->get();
        $mobile_app=Setting::where('common_key','app')->get();
        $del_app=Setting::where('common_key','del_app')->first();
        $home_video = Setting::where('common_key','video_url')->first();

        $map=Policy::where('key','map')->first();
        return view('admin.settings.index',compact('logo','fevicon','contacts','social_links','map',
        'mobile_app','del_app','home_video'));
    }

    public function create(Request $request)
    {
        return view('admin.settings.create',compact('request'));
    }
    public function store(Request $request)
    {
        return $this->repository->createSetting($request);
    }

    public function show($id)
    {
        $map=Policy::where('id',$id)->first();
        return view('admin.settings.view',compact('map'));
    }

    public function edit(Request $request ,$id)
    {
        $type=$request->type ?? '';
        if($type=='map'){
            $setting=Policy::where('id',$id)->first();
            $type='map';
        }else{
            $setting= $this->repository->getSetting($id);
        }
        return view('admin.settings.edit',compact('setting','type'));
    }

    // public function update(SettingsRequest $request, $id)
    public function update(Request $request, $id)
    {
        return $this->repository->updateSetting($request, $id);
    }

    public function destroy($id)
    {
        return $this->repository->deleteSetting($id);
    }
}
