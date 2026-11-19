<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    protected  = [
        'badge_number', 'name_en', 'name_ar', 'job_title',
        'department', 'dosimeter_id', 'latest_radiation_msv'
    ];

    public function trainingRecords(): HasMany
    {
        return ->hasMany(TrainingRecord::class);
    }
}
