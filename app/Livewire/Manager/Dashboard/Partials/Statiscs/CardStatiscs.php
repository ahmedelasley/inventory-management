<?php

namespace App\Livewire\Manager\Dashboard\Partials\Statiscs;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\{Restaurant, WarehouseStock, KitchenStock};
use Illuminate\Support\Facades\DB;

class CardStatiscs extends Component
{
    use WithPagination, WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $WarehousesStocks = WarehouseStock::sum('quantity');
        $KitchenStocks = KitchenStock::sum('quantity');

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

        // تحميل العلاقات المطلوبة
        $restaurants = Restaurant::with(['kitchens.stocks', 'warehouses.stocks'])->get();

        $datasetsKitchens = [];
        $datasetsWarehouses = [];
        $kitchenNames = [];
        $warehouseNames = [];
        $colorsKitchens = [];
        $colorsWarehouses = [];

        // دالة لتوليد ألوان ثابتة
        function generateColor($name)
        {
            return '#' . substr(md5($name), 0, 6);
        }

        // جمع أسماء المطابخ والمخازن وألوانها
        foreach ($restaurants as $restaurant) {
            foreach ($restaurant->kitchens as $kitchen) {
                if (!in_array($kitchen->name, $kitchenNames)) {
                    $kitchenNames[] = $kitchen->name;
                    $colorsKitchens[] = generateColor($kitchen->name);
                }
            }
            foreach ($restaurant->warehouses as $warehouse) {
                if (!in_array($warehouse->name, $warehouseNames)) {
                    $warehouseNames[] = $warehouse->name;
                    $colorsWarehouses[] = generateColor($warehouse->name);
                }
            }
        }

        // إعداد بيانات كل مطعم
        foreach ($restaurants as $restaurant) {
            $kitchenCounts = array_fill(0, count($kitchenNames), 0);
            $warehousesCounts = array_fill(0, count($warehouseNames), 0);

            foreach ($restaurant->kitchens as $kitchen) {
                $index = array_search($kitchen->name, $kitchenNames);
                if ($index !== false) {
                    $kitchenCounts[$index] = $kitchen->stocks->sum('quantity');
                }
            }

            foreach ($restaurant->warehouses as $warehouse) {
                $index = array_search($warehouse->name, $warehouseNames);
                if ($index !== false) {
                    $warehousesCounts[$index] = $warehouse->stocks->sum('quantity');
                }
            }

            // إضافة بيانات المطاعم إلى المخططات
            $datasetsKitchens[] = [
                "label" => $restaurant->name,
                'backgroundColor' => $colorsKitchens,
                'data' => $kitchenCounts,
            ];

            $datasetsWarehouses[] = [
                "label" => $restaurant->name,
                'backgroundColor' => $colorsWarehouses,
                'data' => $warehousesCounts,
            ];
        }

        // إنشاء المخططات
        $stackedBarChartKitchens = app()->chartjs
            ->name('stackedBarChartKitchens')
            ->type('bar')
            ->labels($kitchenNames)
            ->datasets($datasetsKitchens)
            ->options([]);

        $stackedBarChartWarehouses = app()->chartjs
            ->name('stackedBarChartWarehouses')
            ->type('bar')
            ->labels($warehouseNames)
            ->datasets($datasetsWarehouses)
            ->options([]);

        return view('manager.dashboard.partials.statiscs.card-statiscs', [
            'chartjsStocks' => $chartjsStocks,
            'stackedBarChartKitchens' => $stackedBarChartKitchens,
            'stackedBarChartWarehouses' => $stackedBarChartWarehouses,
        ]);
    }
}
