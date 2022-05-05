<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Jobs;


class Prefecture extends Model
{
    use HasFactory;

    public function   Jobs()
    {
        return $this->belongsToMany(Jobs::class, 'job_locations', 'prefectures_id', 'jobs_id');
    }
}
