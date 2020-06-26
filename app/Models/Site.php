<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $fillable = ['id', 'server_id', 'data', 'created_at'];

    protected $casts = [
        'data' => 'json'
    ];
}
