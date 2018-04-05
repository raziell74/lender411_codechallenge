<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at'];

    public function players() {
        return $this->hasMany('App\Player');
    }

    public function toArray($includePlayers = true) {
        $data = parent::toArray();
        if($includePlayers) {
            $data['players'] = [];
            $this->players()->each(function($player) use(&$data) {
                $data['players'][] = $player->toArray(false);
            });
        }
        return $data;
    }
}
