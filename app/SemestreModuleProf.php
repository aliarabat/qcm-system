<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SemestreModuleProf extends Model
{
    protected $fillable=['semestre_module_id','professor_id', 'annee'];

    public function semestreModule(){
        return $this->belongsTo('App\SemestreModule');
    }
    public function professor(){
        return $this->belongsTo('App\User');
    }
}
