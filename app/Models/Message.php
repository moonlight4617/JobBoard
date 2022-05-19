<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ContactUsers;


class Message extends Model
{
    use HasFactory;

    public function ContactUsers()
    {
        return $this->belongsTo(ContactUsers::class);
    }
}
