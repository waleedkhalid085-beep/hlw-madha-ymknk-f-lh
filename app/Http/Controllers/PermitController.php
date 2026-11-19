<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PermitController extends Controller
{
    public function index()
    {
        return view('hse.permits');
    }

    public function store(Request )
    {
        return response()->json([
            'permit_number' => 'PTW-' . date('Y') . '-' . rand(1000, 9999),
            'status' => 'Approved'
        ]);
    }

    public function dosimeterLog()
    {
        return view('hse.dosimeters');
    }
}
