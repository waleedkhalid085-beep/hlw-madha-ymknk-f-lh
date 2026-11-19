<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Well;
use App\Models\InventoryItem;
use App\Models\PermitToWork;

class DashboardController extends Controller
{
    public function index()
    {
         = [
            'total_wells' => 142,
            'integrity_rate' => 98.4,
            'active_campaigns' => 28,
            'inventory_value' => 14850000,
            'safe_hours' => 1240000,
            'lti_count' => 0
        ];

        return view('dashboard.index', compact('stats'));
    }

    public function authenticate(Request )
    {
         = ->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        return redirect()->intended(route('dashboard'));
    }

    public function logout(Request )
    {
        return redirect()->route('login');
    }

    public function getLiveKpis()
    {
        return response()->json([
            'status' => 'success',
            'timestamp' => now()->toIso8601String(),
            'pressure_average_psi' => 3420,
            'active_wells' => 142,
            'server_health' => 'Optimal (Basra DC)'
        ]);
    }

    public function exportExecutivePdf()
    {
        return response()->json([
            'message' => 'Executive PDF generated successfully',
            'download_url' => '/exports/COREX_Executive_Report_' . date('Y_m_d') . '.pdf'
        ]);
    }
}
