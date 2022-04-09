<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Companies;


class ContactUsers extends Model
{
    use HasFactory;

    public function companies()
    {
        return $this->belongsTo(Companies::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'users_id',
        'companies_id',
        'follow'
    ];
}
