<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    use HasFactory;

    public function departament(){
        return $this->belongsTo("App\Models\Departament");
    }

    public function client(){
        return $this->hasMany('App\Models\Client');
    }
}
