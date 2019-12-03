<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Niveau extends Model
{
    //
    protected $fillable=['niveau','type'];

    public function filieres(){
        return $this->hasMany(Filiere::class);
    }

}
