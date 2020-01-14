<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Qcm extends Model
{
    protected $fillable = ['description', 'reference', 'duration', 'difficulty','semestre_module_professor_id'];

    public function semestreModuleProfessor()
    {
        return $this->belongsTo('App\SemestreModuleProf');
    }
}
