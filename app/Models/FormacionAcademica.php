<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormacionAcademica extends Model
{

    public function disciplina()
    {
        return $this->belongsTo(Disciplinas::class, 'disciplina_id');
    }

    public function conocimiento()
    {
        return $this->belongsTo(Disciplinas::class, 'conocimiento_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
