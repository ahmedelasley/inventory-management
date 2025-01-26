<?php

namespace App\Livewire\Supervisor\Dashboard\Partials;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use App\Models\Order;

class Chart extends Component
{
    use WithPagination, WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {

        $year = date('Y');
        
        // Generate month names dynamically
        $monthNames = collect(range(1, 12))->map(function ($month) {
            return Carbon::createFromDate(null, $month)->format('M'); // Generate month names dynamically
        })->toArray();
    
        // Generate dynamic colors for each month
        $colors = collect(range(1, 12))->map(function () {
            return '#' . substr(md5(mt_rand()), 0, 6); // Random hex color
        })->toArray();

        // Group orders by month and sum quantities
        $ordersByMonth = Order::selectRaw('MONTH(created_at) as month, SUM(quantities) as total')
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->pluck('total', 'month');
    
        // Populate data for all 12 months (default to 0 if no data exists)
        $monthlyData = collect(range(1, 12))->map(function ($month) use ($ordersByMonth) {
            return $ordersByMonth[$month] ?? 0;
        })->toArray();
    
        // Create the chart
        $barChartOrders = app()->chartjs
            ->name('barChartOrders')
            ->type('bar')
            ->size(['width' => 300, 'height' => 100])
            ->labels($monthNames)
            ->datasets([
                [
                    "label" => "",
                    'backgroundColor' => $colors,
                    'data' => $monthlyData,
                ]
            ])
            ->options([]);
    
        // Pass chart to the view
        return view('supervisor.dashboard.partials.chart', [
            'barChartOrders' => $barChartOrders,
        ]);
    }

}