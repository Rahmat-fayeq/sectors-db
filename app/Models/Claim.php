<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    public $guarded = [];

    public function departments()
    {
    	return $this->belongsTo('App\Models\Department','dept');
    }

    public function cities()
    {
    	return $this->belongsTo('App\Models\City','city');
    }
}
