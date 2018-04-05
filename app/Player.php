<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = ['first_name', 'last_name'];
    protected $hidden = ['team_id', 'created_at', 'updated_at'];
    
    public function team() {
        return $this->belongsTo('App\Team');
    }

    public function toArray($includeTeam = true) {
        $data = parent::toArray();
        if($includeTeam) {
            $data['team'] = $this->team->toArray(false);
        }
        return $data;
    }
}
