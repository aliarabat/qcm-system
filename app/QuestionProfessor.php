<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionProfessor extends Model
{
    //
    public function question(){
        return $this->belongsTo(Question::class);
    }
    public function professor(){
        return $this->belongsTo(User::class);
    }
}
