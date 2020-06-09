<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MonsterPostedJob extends Model
{
    public function city()
    {
        return $this->belongsTo('App\MonsterLocation', 'monster_location_id');
    }
}
