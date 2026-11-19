<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WorkforceController extends Controller
{
    public function trainingMatrix()
    {
        return view('workforce.matrix');
    }

    public function certificates()
    {
        return view('workforce.certificates', compact('employeeId'));
    }

    public function downloadCertificatePdf()
    {
        return response()->json([
            'cert_id' => ,
            'status' => 'generated'
        ]);
    }
}
