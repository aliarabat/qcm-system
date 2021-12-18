<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chapitre extends Model
{
    //
    protected $fillable=['nom_chapitre'];

public function module(){
        return $this->belongsTo(Module::class);
    }

    public function questions(){
        return $this->belonhagsTo(Question::class);
    }
}
