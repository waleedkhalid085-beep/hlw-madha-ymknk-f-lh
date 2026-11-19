<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InventoryItem;
use App\Models\MaterialRequest;

class InventoryController extends Controller
{
    public function index()
    {
        return view('inventory.index');
    }

    public function storeGoodsIssue(Request )
    {
         = ->validate([
            'item_code' => 'required',
            'quantity' => 'required|numeric|min:1',
            'well_number' => 'required',
            'receiver_name' => 'required'
        ]);

        return response()->json([
            'status' => 'success',
            'voucher_number' => 'GI-' . date('Ymd') . '-' . rand(1000, 9999),
            'message' => 'Goods Issue Voucher generated successfully'
        ]);
    }

    public function exportExcel()
    {
        return response()->json([
            'download' => 'COREX_Stock_Balance_' . date('Y_m_d') . '.xlsx'
        ]);
    }
}
