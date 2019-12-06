<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable=['question','chapitre','duree','difficulte','visibilite','note'];

    public function propositions(){
        return $this->hasMany(Proposition::class);
    }

    public function typeQuestion(){
        return $this->belongsTo(TypeQuestion::class);
    }

    public function chapitres()
    {
        return $this->hasMany(Chapitre::class);
    }
}
