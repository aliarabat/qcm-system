<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proposition extends Model
{
    protected $fillable=['proposition','reponse'=>0];

    public function question(){
        return $this->belongsTo(Question::class);
    }
}
