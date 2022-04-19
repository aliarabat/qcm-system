<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable=['question','chapitre','duree','difficulte','visibilite','note', 'user_id'];

    public function propositions(){
        return $this->hasMany(Proposition::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function chapitres()
    {
        return $this->hasMany(Chapitre::class);
    }
}
