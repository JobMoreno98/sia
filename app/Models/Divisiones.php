<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Divisiones extends Model
{
    protected $guarded = [];

    public function departamentos(){
        return $this->hasMany(Departamentos::class,'division_id');
    }
}
