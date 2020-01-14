<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    protected $fillable = [
        'responses', 'qcm_users_id', 'question_id'
    ];

    public function qcmUser()
    {
        return $this->belongsTo('App\QcmUsers');
    }

    public function question()
    {
        return $this->belongsTo('App\Question');
    }
}
