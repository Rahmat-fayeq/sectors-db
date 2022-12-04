<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectorSourceReport extends Model
{
    public $guarded = [];

    public function cities()
    {
    	return $this->belongsTo('App\Models\City','city');
    }
}
