<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Companies;
use App\Models\AppStatus;

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

    protected $fillable = [
        'companies_id',
        'job_name',
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
}
