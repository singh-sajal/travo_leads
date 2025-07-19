<?php
namespace App\Http\Controllers\Admin\Policy;

use App\Models\Policy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PolicyController extends Controller
{
    protected $repository;
    public function __construct(PolicyRepository $repository)
    {
        $this->repository = $repository;
    }
    public function index(Request $request)
    {
        // if (request()->ajax()) {
        //     $table = $this->repository->buildDataTable($request);
        //     return $table;
        // }
        $policies = Policy::where('key','!=','map')->get();
        // return $policies;
        return view('admin.policy.index',compact('policies'));
    }

    // public function create()
    // {
    //     return view('admin.policy.create');
    // }
    // public function store(PolicyRequest $request)
    // {
    //     return $this->repository->createRow($request);
    // }
    // public function show($id)
    // {
    //     $row = $this->repository->getRow($id);
    //     return view('admin.policy.view', compact('row'));
    // }
    public function edit($id)
    {
        $row = $this->repository->getRow($id);
        return view('admin.policy.edit', compact('row'));
    }
    public function update(PolicyRequest $request, $id)
    {
        return $this->repository->updateRow($request, $id);
    }

    // public function destroy($id)
    // {
    //     return $this->repository->deleteRow($id);
    // }
}
