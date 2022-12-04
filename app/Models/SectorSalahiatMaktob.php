<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectorSalahiatMaktob extends Model
{
    public $guarded = [];

    public function setQuarterAttribute($value)
    {
        $this->attributes['quarter'] = json_encode($value);
    }

    public function getQuarterAttribute($value)
    {
        return $this->attributes['quarter'] = json_decode($value);
    }

}
