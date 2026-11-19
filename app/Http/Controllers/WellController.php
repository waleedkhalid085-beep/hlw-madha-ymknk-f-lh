<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Well;
use App\Models\Valve;

class WellController extends Controller
{
    public function index()
    {
        return view('wells.index');
    }

    public function treeSimulator()
    {
        return view('wells.tree', compact('wellId'));
    }

    public function passport()
    {
        return view('wells.passport', compact('wellId'));
    }

    public function recordValveService(Request , , )
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Valve servicing and torque test logged successfully.'
        ]);
    }

    public function downloadPassportPdf()
    {
        return response()->json([
            'file' => "Well_Passport_{}.pdf",
            'status' => 'ready'
        ]);
    }
}
