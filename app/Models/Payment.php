<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'payment';
    protected $primaryKey = 'payment_id';

    public function setAmountAttribute($value){
        $this->attributes['amount'] = $value * 100;
    }
}
