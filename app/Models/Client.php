<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    public function login(){
        return $this->hasMany('App\Models\Login');
    }

    public function documentType(){
        return $this->belongsTo('App\Models\DocumentType');
    }

    public function municipality(){
        return $this->belongsTo('App\Models\Municipality');
    }
}
