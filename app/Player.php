<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    public function players() {
        return $this->belongsTo('App\Team');
    }
}
