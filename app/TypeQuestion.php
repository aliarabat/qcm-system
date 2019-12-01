<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeQuestion extends Model
{
    protected $fillable=['type'];

    public function questions(){
        return $this->hasMany(Question::class);
    }
}
