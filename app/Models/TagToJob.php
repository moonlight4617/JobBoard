<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Jobs;
use App\Models\Tag;

class TagToJob extends Model
{
    use HasFactory;

    public function Tag()
    {
        return $this->hasMany(Tag::class);
    }

    public function Jobs()
    {
        return $this->hasMany(Jobs::class);
    }
}
