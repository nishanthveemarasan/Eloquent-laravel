<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Upload;
use App\Models\Payment;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class ModelController extends Controller
{
    public function modelGet()
    {
        $getPayment = Payment::first()->toArray();
        $array = array('a' => 'b');
        $time = now()->addMinutes(30);
        Cache::forget('key');
        dd(Cache::get('key'));
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
