<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TagToJob;
use App\Models\TagToUser;
use App\Models\User;

class Tag extends Model
{
    use HasFactory;

    public function tagToJob()
    {
        return $this->belongsTo(TagToJob::class);
    }

    public function tagToUser()
    {
        return $this->belongsTo(TagToUser::class);
    }
}
