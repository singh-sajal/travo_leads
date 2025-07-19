<?php

namespace App\Http\Controllers\Admin\WebQuery;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\WebQuery\WebQueryRepository;


class WebQueryController extends Controller
{
    protected $repository;
    public function __construct(WebQueryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        if (request()->ajax()) {
            $table = $this->repository->buildDataTable($request);
            return $table;
        }

        return view('admin.webquery.index');
    }

    public function show($id)
    {
        $row = $this->repository->getRow($id);
        return view('admin.webquery.view',compact('row'));
    }


    public function destroy($id)
    {
        return $this->repository->deleteRow($id);
    }

    public function change_status(Request $request, $id){
        return $this->repository->changeStatus( $request, $id);
    }
}
