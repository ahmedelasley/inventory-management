<?php

namespace App\Livewire\Admin\Dashboard\Partials;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use App\Models\Restaurant;
use App\Models\Kitchen;use Livewire\Attributes\On; 


class ChartBarKitchens extends Component
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
    //         ->ofKitchen(Auth::guard('admin')->user()->kitchen->id)
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
    //     ->ofKitchen(Auth::guard('admin')->user()->kitchen->id)
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



      
      // استرجاع المطاعم مع المطابخ المرتبطة بها
      $restaurants = Restaurant::with('kitchens.stocks')->get();
      
      $datasets = [];
      $kitchenNames = [];
      $colorsKitchens = [];
      
      // جمع أسماء المطابخ الفريدة
      foreach ($restaurants as $restaurant) {
          foreach ($restaurant->kitchens as $kitchen) {
              if (!in_array($kitchen->name, $kitchenNames)) {
                  $kitchenNames[] = $kitchen->name;
                  $colorsKitchens[] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
              }
          }
      }
      
      // إعداد بيانات كل مطعم
      foreach ($restaurants as $restaurant) {
          $kitchenCounts = array_fill(0, count($kitchenNames), 0); // تهيئة مصفوفة بالصفر
      
          foreach ($restaurant->kitchens as $kitchen) {
              $index = array_search($kitchen->name, $kitchenNames); // الحصول على موقع المطبخ
              $kitchenCounts[$index] = $kitchen->stocks->sum('quantity'); // تعيين كمية المخزون
          }
      
          // إضافة بيانات المطعم إلى المخطط
          $datasets[] = [
              "label" => $restaurant->name, // اسم المطعم
              'backgroundColor' => $colorsKitchens, // ألوان المطابخ
              'data' => $kitchenCounts, // بيانات كمية المخزون
          ];
      }
      
      // إنشاء المخطط
      $stackedBarChart = app()->chartjs
          ->name('stackedBarChartKitchens')
          ->type('bar')
          ->size(['width' => 300, 'height' => 100])
          ->labels($kitchenNames) // أسماء المطابخ كـ labels
          ->datasets($datasets) // بيانات المطاعم والمطابخ
          ->options([
              'scales' => [
                  'x' => [
                      'stacked' => true, // تفعيل التكديس على المحور الأفقي
                  ],
                  'y' => [
                      'stacked' => true, // تفعيل التكديس على المحور الرأسي
                      'beginAtZero' => true,
                  ],
              ],
          ]);
      
      
        return view('admin.dashboard.partials.chart-bar-kitchens', [
            'stackedBarChart' => $stackedBarChart,
        ]);
    }

}