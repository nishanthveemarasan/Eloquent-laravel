<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Upload;
use App\Models\Payment;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use App\Events\NewCustomerHasRegisteredEvent;

class ModelController extends Controller
{
    public function modelGet()
    {
        $getPayment = Payment::first();
        $array = array('a' => 'b');
        $time = now()->addMinutes(30);
        
        //once we create a user
        event(new NewCustomerHasRegisteredEvent($getPayment));
        //sendng welcome email

        //Regiter the new users to News Letter

        //Slack notification to admin about new users

        //Listers listring for specific event to happen
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
