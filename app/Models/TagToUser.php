<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Tag;

class TagToUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'tags_id',
    ];
}
