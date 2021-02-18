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
        $getCity = DB::table('payment')
                        ->join('customer', 'customer.customer_id', '=', 'payment.customer_id')
                        ->join('staff', 'staff.staff_id', '=', 'payment.staff_id')
                        ->select('payment.*', DB::raw('CONCAT(customer.first_name," ",customer.last_name) as customer_name'), 
                            DB::raw('CONCAT(staff.first_name," ",staff.last_name )as staff_name'))
                        ->limit(100)
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
