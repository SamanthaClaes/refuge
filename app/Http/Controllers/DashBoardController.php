<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Livewire\Pages\⚡dashboard\Dashboard;



class DashBoardController extends Controller
{
    public function downloadPdf()
{
    $driver = DB::getDriverName();

    $monthExpression = match ($driver) {
        'sqlite' => "strftime('%m', created_at)",
        default  => "MONTH(created_at)",
    };

    $adopted = Animal::selectRaw("$monthExpression as month, COUNT(*) as total")
        ->where('status', 'adopted')
        ->groupBy('month')
        ->pluck('total', 'month');

    $arrived = Animal::selectRaw("$monthExpression as month, COUNT(*) as total")
        ->groupBy('month')
        ->pluck('total', 'month');

    $data = [];

    foreach (range(1, 12) as $m) {
        $key = str_pad($m, 2, '0', STR_PAD_LEFT);

        $data[] = [
            'month' => now()->month($m)->translatedFormat('M'),
            'arrived' => (int) ($arrived[$key] ?? 0),
            'adopted' => (int) ($adopted[$key] ?? 0),
            'remaining' => (int) (($arrived[$key] ?? 0) - ($adopted[$key] ?? 0)),
        ];
    }

    return Pdf::loadView('livewire.export-dashboard-pdf', [
        'data' => $data
    ])
        ->setPaper('a4')
        ->download('rapport-animaux-' . now()->format('Y-m-d') . '.pdf');
}

}
