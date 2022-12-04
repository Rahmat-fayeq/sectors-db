<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Control extends Model
{
    public $guarded = [];

    public function departments()
    {
    	return $this->belongsTo('App\Models\Department','dept');
    }
    // public function setAuditorsAttribute($value)
    // {
    //     $this->attributes['auditors'] = json_encode($value);
    // }

    // public function getAuditorsAttribute($value)
    // {
    //     return $this->attributes['auditors'] = json_decode($value);
    // }
}
