<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asesoria extends Model
{
    protected $guarded = [];
    public function programa()
    {
        return $this->belongsTo(ProgramaEducativo::class, 'programa_id')->orderBy('nombre');
    }
}
