<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class CustomerManegmentController extends Controller
{
    /**
     * Display a listing of the city master data.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.customer.list');
    }

    public function getAjaxCustomerData()
    {
        $model = Customer::query()->orderBy('name', 'asc');

        return DataTables::eloquent($model)
            ->addIndexColumn()
            ->editColumn('name', function ($data) {
                return $data['name'];
            })
            ->editColumn('email', function ($data) {
                return $data['email'];
            })
            ->rawColumns(['edit'])
            ->toJson();
    }
}
