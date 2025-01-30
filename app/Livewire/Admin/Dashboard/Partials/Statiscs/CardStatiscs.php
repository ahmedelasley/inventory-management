<?php

namespace App\Livewire\Admin\Dashboard\Partials\Statiscs;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use App\Models\Restaurant;

class CardStatiscs extends Component
{
    use WithPagination, WithFileUploads;
    protected $paginationTheme = 'bootstrap';


    public function render()
    {
        $WarehousesStocks = \App\Models\WarehouseStock::sum('quantity');
        $KitchenStocks = \App\Models\KitchenStock::sum('quantity');
      
        $chartjsStocks = app()->chartjs
          ->name('pieChartStocks')
          ->type('doughnut')
          ->size(['width' => 100, 'height' => 50])
          ->labels(['Warehouses', 'Kitchens'])
          ->datasets([
            [
              'backgroundColor' => ['#8A2BE2', '#008B8B'],
              'data' => [$WarehousesStocks, $KitchenStocks]
            ],
          ])->options([]); 

      // استرجاع المطاعم مع المطابخ المرتبطة بها
      $restaurants = Restaurant::with('kitchens.stocks')->get();
      
      $datasetsKitchens = [];
      $kitchenNames = [];
      $colorsKitchens = [];
      
      $datasetsWarehouses = [];
      $warehouseNames = [];
      $colorsWarehouses = [];

      // جمع أسماء المطابخ الفريدة
      foreach ($restaurants as $restaurant) {
          foreach ($restaurant->kitchens as $kitchen) {
              if (!in_array($kitchen->name, $kitchenNames)) {
                  $kitchenNames[] = $kitchen->name;
                  $colorsKitchens[] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
              }
          }

          foreach ($restaurant->warehouses as $warehouse) {
            if (!in_array($warehouse->name, $warehouseNames)) {
                $warehouseNames[] = $warehouse->name;
                $colorsWarehouses[] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
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
      
          $warehousesCounts = array_fill(0, count($warehouseNames), 0); // تهيئة مصفوفة بالصفر
      
          foreach ($restaurant->warehouses as $warehouse) {
              $index = array_search($warehouse->name, $warehouseNames); // الحصول على موقع المطبخ
              $warehousesCounts[$index] = $warehouse->stocks->sum('quantity'); // تعيين كمية المخزون
          }

          // إضافة بيانات المطعم إلى المخطط
          $datasetsKitchens[] = [
            "label" => $restaurant->name, // اسم المطعم
            'backgroundColor' => $colorsKitchens, // ألوان المطابخ
            'data' => $kitchenCounts, // بيانات كمية المخزون
        ];

        $datasetsWarehouses[] = [
            "label" => $restaurant->name, // اسم المطعم
            'backgroundColor' => $colorsWarehouses, // ألوان المطابخ
            'data' => $warehousesCounts, // بيانات كمية المخزون
        ];
  }
      
      // إنشاء المخطط
      $stackedBarChartKitchens = app()->chartjs
          ->name('stackedBarChartKitchens')
          ->type('bar')
        //   ->size(['width' => 300, 'height' => 100])
          ->labels($kitchenNames) // أسماء المطابخ كـ labels
          ->datasets($datasetsKitchens) // بيانات المطاعم والمطابخ
          ->options([]);

        $stackedBarChartWarehouses = app()->chartjs
          ->name('stackedBarChartWarehouses')
          ->type('bar')
        //   ->size(['width' => 300, 'height' => 100])
          ->labels($warehouseNames) // أسماء المطابخ كـ labels
          ->datasets($datasetsWarehouses) // بيانات المطاعم والمطابخ
          ->options([]);



        return view('admin.dashboard.partials.statiscs.card-statiscs', [
            'chartjsStocks' => $chartjsStocks,
            'stackedBarChartKitchens' => $stackedBarChartKitchens,
            'stackedBarChartWarehouses' => $stackedBarChartWarehouses,
        ]);

    }
}
