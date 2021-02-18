<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Payment;
use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ModelController extends Controller
{
    public function modelGet()
    {
        $cusId = array(1, 2, 3, 4, 5, 8);
        $getCity = Payment::select('customer_id', DB::raw('sum(amount) as totalPayment , count(customer_id) as totalRecords'))
            ->whereMonth('payment_date', '2')
            ->groupBy('customer_id')
            ->get()
            ->toArray();
        dd($getCity);
    }

    public function writeCode()
    {
        $sql = Payment::where('votes', '>', '100')
            ->orWhere(function ($query) {
                $query->where('name', 'Abc')
                    ->where('votes', '>', '100');
            })
            ->get()
            ->toArray();
    }
}
