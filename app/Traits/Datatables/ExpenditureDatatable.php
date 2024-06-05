<?php

namespace App\Traits\Datatables;

use App\Helpers\CurrencyHelper;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\DataTables;

trait ExpenditureDatatable
{

    /**
     * Datatable mockup for transactions
     *
     * @param mixed $collection
     *
     * @return JsonResponse
     * @throws Exception
     */

    public function ExpenditureMockup(mixed $collection): JsonResponse
    {
        return DataTables::of($collection)
            ->addIndexColumn()
            ->setFilteredRecords(250)
            ->editColumn('used_for',function($data){
                return view('dashboard.pages.administrator.expenditure.datatable.used-for',compact('data'));
            })
            ->editColumn('action', function ($data) {
                return view('dashboard.pages.administrator.expenditure.datatable.action', compact('data'));
            })
            ->editColumn('balance_withdrawn', function ($data) {
                return view('dashboard.pages.administrator.expenditure.datatable.balance-withdrawn', compact('data'));
            })
            ->editColumn('created_at', function ($data) {
                return Carbon::parse($data->created_at)->format('Y-m-d H:i:s');
            })
            ->rawColumns(['action'])
            ->toJson();
    }
}
