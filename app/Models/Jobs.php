<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Companies;
use App\Models\AppStatus;
use App\Models\TagToJob;
use App\Models\Tag;
use App\Models\Prefecture;
use App\Enums\EmpStatus;

class Jobs extends Model
{
    use HasFactory;

    public function companies()
    {
        return $this->belongsTo(Companies::class);
    }
    public function appStatus()
    {
        return $this->hasMany(AppStatus::class);
    }

    public function  TagToJob()
    {
        return $this->hasMany(TagToJob::class, 'jobs_id');
    }

    protected $fillable = [
        'companies_id',
        'job_name',
        'catch',
        'emp_status',
        'detail',
        'conditions',
        'duty_hours',
        'low_salary',
        'high_salary',
        'holiday',
        'benefits',
        'rec_status',
        'image1',
        'image2',
        'image3'
    ];

    public function isLikedBy($user): bool
    {
        return AppStatus::where('users_id', $user->id)->where('jobs_id', $this->id)->where('favorite', true)->first() !== null;
    }

    public function isApplied($user): bool
    {
        return AppStatus::where('users_id', $user->id)->where('jobs_id', $this->id)->where('app_flag', true)->first() !== null;
    }

    public function  Tags()
    {
        return $this->belongsToMany(Tag::class, 'tag_to_jobs', 'jobs_id', 'tags_id');
    }

    public function  Prefectures()
    {
        return $this->belongsToMany(Prefecture::class, 'job_locations', 'jobs_id', 'prefectures_id');
    }

    public function  empStatus()
    {
        return EmpStatus::getDescription($this->emp_status);
    }
}
