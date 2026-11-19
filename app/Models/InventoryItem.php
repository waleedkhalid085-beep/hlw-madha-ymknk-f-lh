<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    protected  = [
        'item_code', 'name_en', 'name_ar', 'category',
        'stock_quantity', 'reorder_level', 'unit_cost_usd',
        'warehouse_location'
    ];
}
