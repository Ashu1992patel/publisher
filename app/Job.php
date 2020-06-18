<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = ['job_title', 'designation', 'expire_on', 'job_type', 'vacancies', 'salary_type', 'minimum_salary', 'maximum_salary', 'job_description', 'company_id', 'company_url', 'company_description', 'click_india_job_category_id', 'click_india_city_id', 'click_india_minimum_qualification', 'click_india_minimum_experience', 'click_india_working_days', 'click_india_required_candidate', 'click_india_hiring_process'];

    public function company()
    {
        return $this->belongsTo('App\Company', 'company_id');
    }

    public function click_india_city()
    {
        return $this->belongsTo('App\ClickIndiaCity', 'click_india_city_id');
    }

    public function job_to_clickindia()
    {
        return $this->hasMany('App\JobToClickIndia');
        // return $this->hasMany(JobToClickIndia::where('job_id', $this->id)->get());
    }
}
