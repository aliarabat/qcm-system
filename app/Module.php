<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    //
    protected $fillable=['nom_module','libelle'];

    public function chapitres()
    {
        return $this->hasMany(Chapitre::class);
    }
    public function filieres()
    {
        return $this->hasMany(Filiere::class);
    }

}
