<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auditor extends Model
{
    public $guarded = [];

    public function departments()
    {
    	return $this->belongsTo('App\Models\Department','dept');
    }

}
