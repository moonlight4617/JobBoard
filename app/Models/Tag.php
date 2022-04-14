<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Jobs;

class Tag extends Model
{
    use HasFactory;

    public function Jobs()
    {
        return $this->belongsToMany(Jobs::class, 'tag_to_jobs', 'jobs_id', 'users_id');
    }

    public function  Users()
    {
        return $this->belongsToMany(User::class, 'tag_to_users', 'tags_id', 'users_id');
    }
}
