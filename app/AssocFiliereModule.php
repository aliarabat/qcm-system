<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssocFiliereModule extends Model
{
    //
    public function module(){
        return $this->belongsTo(Module::class);
    }
    public function filiere(){
        return $this->belongsTo(Filiere::class);
    }
}
