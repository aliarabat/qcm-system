<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QcmUsers extends Model
{
    protected $fillable = ['user_id', 'qcm_id', 'is_passed', 'note'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function qcm()
    {
        return $this->belongsTo('App\Qcm');
    }
}
