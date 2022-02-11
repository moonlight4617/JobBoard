<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Companies;

class Jobs extends Model
{
    use HasFactory;

    public function companies()
    {
        return $this->belongsTo(Companies::class);
    }
}
