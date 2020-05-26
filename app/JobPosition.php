<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobPosition extends Model
{
    public $fillable = [
        'clientId', 'positionState', 'positionCity', 'positionName', 'closeDate', 'openings', 'location', 'skillSet', 'job_description', 'minYearExp', 'maxYearExp', 'eduQualification', 'minSalary', 'maxSalary', 'jobType', 'industry', 'level', 'gender'
    ];
}
