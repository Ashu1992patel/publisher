<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobToClickIndia extends Model
{
    public function job_to_clickindia()
    {
        return $this->hasMany('App\Jobs', 'job_id');
    }
}
