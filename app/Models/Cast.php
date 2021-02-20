<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cast extends Model
{
    use HasFactory;
    protected $table = 'cast';
    public $timestamps = false;
    protected $guarded = []; // if it is empty then all values wil be inserted

    protected $casts = [
        'number' => 'integer',
        'boolean' => 'boolean',
        'json' => 'array'
    ];
}
