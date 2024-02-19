<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class PromotionalCode extends Model
{
    use HasFactory;

    protected $fillable = ["promotional_code", "package_id", "user_id", "is_used", "expiration_date"];
    protected $dates    = ["expiration_date"];


    /*************************************************************************************
     * RELATIONCHIPS
     ************************************************************************************/
    public function package() {
        return $this->belongsTo(Package::class, "package_id");
    }

    public function user() {
        return $this->belongsTo(User::class, "user_id");
    }


    /*************************************************************************************
     * FUNCTIONS
     ************************************************************************************/
    public function isAvailable(): bool
    {
        return $this->is_used == false && $this->expiration_date->greaterThan(now());
    }
}
