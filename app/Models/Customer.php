<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customer';
    protected $primaryKey = 'customer_id';

    public function getFullNameAttribute()
    {
        return $this->first_name." ".$this->last_name;
    }

    public function getEmailAttribute($value){
        return strtolower($value);
    }

    public function getFirstNameAttribute($value){
        $this->attributes['first_name'] = strtolower($value);
    }

}
