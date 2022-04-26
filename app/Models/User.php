<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\AppStatus;
use App\Models\UserPictures;
use App\Models\ContactUsers;
use App\Models\Tag;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;


    public function appStatus()
    {
        return $this->hasMany(AppStatus::class, 'users_id');
    }

    public function userPictures()
    {
        return $this->hasMany(UserPictures::class, 'users_id');
    }

    public function ContactUsers()
    {
        return $this->hasMany(ContactUsers::class, 'users_id');
    }

    public function  Tags()
    {
        return $this->belongsToMany(Tag::class, 'tag_to_users', 'users_id', 'tags_id')->withTimestamps();
    }

    public function isFollowedBy($company): bool
    {
        return ContactUsers::where('users_id', $this->id)->where('companies_id', $company->id)->where('follow', true)->first() !== null;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'catch',
        'intro',
        'license',
        'career',
        'hobby',
        'pro_image',
        'portfolio1',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
