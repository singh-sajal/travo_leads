<?php
namespace App\Http\Controllers\Admin\Dashboard;

use App\Models\Query;
use App\Models\Banner;
use App\Models\Package;
use App\Models\Destination;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $bannerCount = Banner::count();
        $destinationCount = Destination::count();
        $packageCount = Package::count();
        $queryCount = Query::count(); // Total leads

        return view('admin.dashboard', compact('bannerCount', 'destinationCount', 'packageCount', 'queryCount'));
    }
}
