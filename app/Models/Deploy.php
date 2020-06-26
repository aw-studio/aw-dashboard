<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deploy extends Model
{
    protected $fillable = ['id', 'site_id', 'data'];

    protected $casts = [
        'data' => 'json'
    ];

    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}
