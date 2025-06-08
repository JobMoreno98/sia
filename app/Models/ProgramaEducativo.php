<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramaEducativo extends Model
{
      protected $guarded = [];
    public function departamento()
    {
        return $this->belongsTo(Departamentos::class, 'departamento_id');
    }
}
