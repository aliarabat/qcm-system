<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Filiere extends Model
{
    //
    protected $fillable=['nom_filiere','libelle'];

    public function niveau(){
        return $this->belongsTo(Niveau::class);
    }

    public function modules()
    {
        return $this->hasMany(Module::class);
    }

    public function semestres()
    {
        return $this->hasMany(Semestre::class);
    }


}
