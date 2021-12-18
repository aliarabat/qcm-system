<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentSemestre extends Model
{
    public function student(){
        return $this->belongsTo(User::class);
    }

    public function semestre(){
        return $this->belongsTo(Semestre::class);
    }
}
