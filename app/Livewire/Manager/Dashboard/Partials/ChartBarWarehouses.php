<?php

namespace App\Livewire\Manager\Dashboard\Partials;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use App\Models\Order;
use Livewire\Attributes\On; 


class ChartBarWarehouses extends Component
{
    use WithPagination, WithFileUploads;
    protected $paginationTheme = 'bootstrap';


    // public $yearChart;
    // public $lastYearChart;
    // public $ordersByMonth;
    // public $monthlyData;
    // public $lastOrdersByMonth;
    // public $lastMonthlyData;


    // public function mount()
    // {
    //     $this->yearChart = (int) date('Y');
    //     $this->lastYearChart = $this->yearChart - 1;
    //     $this->loadChartData();  // Load the initial data when the component is mounted

    // }
    
    // // public function setYear($year)
    // // {
    // //     $this->yearChart = $year;
    // //     $this->loadChartData();  // Load the initial data when the component is mounted
    // //     $this->dispatch('chartUpdated'); // Dispatch an event to notify the frontend

    // // }

    // // A method to load the chart data for the selected year
    // public function loadChartData()
    // {
    //     // Group orders by month and sum quantities for the selected year
    //     $this->ordersByMonth = Order::selectRaw('MONTH(created_at) as month, SUM(quantities) as total')
    //         ->ofKitchen(Auth::guard('manager')->user()->kitchen->id)
    //         ->whereYear('created_at', $this->yearChart)
    //         ->groupBy('month')
    //         ->pluck('total', 'month');

    //     // Populate data for all 12 months (default to 0 if no data exists)
    //     $this->monthlyData = collect(range(1, 12))->map(function ($month) {
    //         return $this->ordersByMonth[$month] ?? 0;
    //     })->toArray();

    //     // Last Year
    //     // Group orders by month and sum quantities for the selected year
    //     $this->lastOrdersByMonth = Order::selectRaw('MONTH(created_at) as month, SUM(quantities) as total')
    //     ->ofKitchen(Auth::guard('manager')->user()->kitchen->id)
    //     ->whereYear('created_at', $this->lastYearChart)
    //     ->groupBy('month')
    //     ->pluck('total', 'month');

    //     // Populate data for all 12 months (default to 0 if no data exists)
    //     $this->lastMonthlyData = collect(range(1, 12))->map(function ($month) {
    //         return $this->lastOrdersByMonth[$month] ?? 0;
    //     })->toArray();

    // }

    // public function chart() 
    // {       
    //     // Generate month names dynamically
    //     $monthNames = collect(range(1, 12))->map(function ($month) {
    //         return Carbon::createFromDate(null, $month)->format('M'); // Generate month names dynamically
    //     })->toArray();

    //     // Create the chart
    //     $barChartOrders = app()->chartjs
    //         ->name('barChartOrders')
    //         ->type('bar')
    //         ->size(['width' => 300, 'height' => 100])
    //         ->labels($monthNames)
    //         ->datasets([
    //             [
    //                 "label" => $this->yearChart,
    //                 'backgroundColor' => getColorSet(1)[0],
    //                 'data' => $this->monthlyData,
    //             ],
    //             [
    //                 "label" => $this->lastYearChart,
    //                 'backgroundColor' => getColorSet(1)[1],
    //                 'data' => $this->lastMonthlyData,
    //             ]

    //         ])
    //         ->options([]);

    //     return $barChartOrders;
    // }

    // #[On('refreshData')] 
    public function render()
    {

      $WarehousesCount = \App\Models\Warehouse::get()->count();
      $KitchensCount = \App\Models\Kitchen::get()->count();
      
      $Warehouses = [];
      $WarehouseCount = [];
      $Kitchens = [];
      // $KitchenCount = [];
      $colorsWarehouses = [];
      // $colorsKitchens = [];
      foreach (\App\Models\Warehouse::get() as $key => $value) {
        $WarehouseCount[] = $value->stocks->sum('quantity') ;
        $Warehouses[] = $value->name;
        $colorsWarehouses[] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    
      }
    
      // foreach (\App\Models\Kitchen::get() as $key => $value) {
      //   $KitchenCount[] = $value->stocks->sum('quantity') ;
      //   $Kitchens[] = $value->name;
      //   $colorsKitchens[] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
      // }
    
      $barChartWarehouses = app()->chartjs
            ->name('barChartWarehouses')
            ->type('bar')
            ->size(['width' => 300, 'height' => 100])
            ->labels($Warehouses) // add labels
            ->datasets([
              [
                "label" => 'Warehouses [ ' . $WarehousesCount . ' ]' ,
                'backgroundColor' => "#FFBD33",
                'data' => $WarehouseCount
              ],
      ])->options([]);
        return view('manager.dashboard.partials.chart-bar-warehouses', [
            'barChartWarehouses' => $barChartWarehouses,
        ]);
    }

}