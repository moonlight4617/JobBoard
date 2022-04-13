<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Tag;

class TagToUser extends Model
{
    use HasFactory;

    public function Tag()
    {
        return $this->hasMany(Tag::class);
    }

    public function User()
    {
        return $this->hasMany(User::class);
    }

    protected $fillable = [
        'users_id',
        'tags_id',
    ];
}
