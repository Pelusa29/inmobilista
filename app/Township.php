<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Township extends Model
{
    protected $table = 'townships';
    protected $fillable = [
        'city_id', 'name', 'slug', 'status'
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
