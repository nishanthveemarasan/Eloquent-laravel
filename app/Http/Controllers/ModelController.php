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

        $getCity = Payment::where('amount', '>', '2')
                    ->orWhere('customer_id', '<', '10')
                    ->get()->toArray();
        dd($getCity);
    }

    public function writeCode(){
        $sql = Payment::where('votes' , '>' , '100')
                        ->orWhere(function($query){
                            $query->where('name' , 'Abc')
                                    ->where('votes' ,'>','100');
                        })
                        ->get()
                        ->toArray();
    }
}
