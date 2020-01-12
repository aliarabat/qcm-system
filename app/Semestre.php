<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semestre extends Model
{
    protected $fillable=['libelle'];

    public function filiere(){
        return $this->belongsTo(Filiere::class);
    }

    public function students()
    {
        return $this->hasMany('App\User');
    }



}
