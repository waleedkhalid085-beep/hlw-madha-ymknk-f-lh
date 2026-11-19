<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TrainingRecord extends Model
{
    protected  = [
        'employee_id', 'course_name', 'certificate_number',
        'issue_date', 'expiry_date', 'status'
    ];

    public function employee(): BelongsTo
    {
        return ->belongsTo(Employee::class);
    }
}
