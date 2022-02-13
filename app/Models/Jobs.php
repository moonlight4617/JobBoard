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

    protected $fillable = [
        'companies_id',
        'job_name',
        'detail',
        'conditions',
        'duty_hours',
        'low_salary',
        'high_salary',
        'holiday',
        'benefits',
        'rec_status',
        'image1',
        'image2',
        'image3'
    ];
}
