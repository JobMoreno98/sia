<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departamentos extends Model
{
    protected $guarded = [];
    public function division()
    {
        return $this->belongsTo(Divisiones::class, 'division_id');
    }
}
