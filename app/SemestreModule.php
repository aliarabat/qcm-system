<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SemestreModule extends Model
{
    protected $fillable=['semestre_id','module_id'];

    public function module(){
        return $this->belongsTo(Module::class);
    }
    public function semestre(){
        return $this->belongsTo(Semestre::class);
    }

}
