<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Valve extends Model
{
    protected  = [
        'well_id', 'valve_type', 'tag_number', 'operation_mode',
        'current_state', 'operating_pressure_psi', 'last_lubricated_at',
        'integrity_status'
    ];

    public function well(): BelongsTo
    {
        return ->belongsTo(Well::class);
    }
}
