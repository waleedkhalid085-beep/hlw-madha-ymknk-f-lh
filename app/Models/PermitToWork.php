<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermitToWork extends Model
{
    protected  = [
        'permit_number', 'permit_type', 'well_id',
        'work_description', 'performing_authority',
        'valid_from', 'valid_until', 'status'
    ];
}
