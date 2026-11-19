<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Well extends Model
{
    protected  = [
        'oilfield_id', 'well_number', 'reservoir', 'total_depth_meters',
        'tree_manufacturer', 'tree_rating_psi', 'tubing_pressure_psi',
        'casing_pressure_psi', 'status', 'last_integrity_test_at'
    ];

    public function valves(): HasMany
    {
        return ->hasMany(Valve::class);
    }
}
