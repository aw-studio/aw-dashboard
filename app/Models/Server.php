<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    protected $fillable = ['id', 'name', 'data', 'created_at'];

    protected $casts = [
        'data' => 'json'
    ];
}
