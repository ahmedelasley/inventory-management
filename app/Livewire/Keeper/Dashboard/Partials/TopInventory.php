<?php

namespace App\Livewire\Keeper\Dashboard\Partials;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use App\Models\WarehouseStock;

class TopInventory extends Component
{
    use WithPagination, WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $data = WarehouseStock::with('product')->ofWarehouse(Auth::guard('keeper')->user()->warehouse->id) // جلب بيانات المنتج المرتبطة
                ->orderBy('quantity', 'desc') // ترتيب المنتجات تصاعدياً حسب الكمية
                ->take(5) // أخذ أقل 5 منتجات فقط
                ->get();

        return view('keeper.dashboard.partials.top-inventory',[
            'data' => $data,
        ]);
    }

}