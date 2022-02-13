<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Jobs;


class Companies extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;

    public function jobs()
    {
        return $this->hasMany(Jobs::class);
    }

    protected $fillable = [
        'name',
        'email',
        'password',
        'intro',
        'image1',
        'image2',
        'tel',
        'post_code',
        'address',
        'homepage',
        'del_flg'
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
