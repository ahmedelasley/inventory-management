<?php

namespace App\Livewire\Manager\Dashboard\Partials;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use App\Models\KitchenStock;

class InventoryKitchens extends Component
{
    use WithPagination, WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        // $data = KitchenStock::with('product')->ofKitchen(Auth::guard('manager')->user()->kitchen->id) // جلب بيانات المنتج المرتبطة
        //         ->orderBy('quantity', 'asc') // ترتيب المنتجات تصاعدياً حسب الكمية
        //         ->take(5) // أخذ أقل 5 منتجات فقط
        //         ->get();

        return view('manager.dashboard.partials.inventory-kitchens',[
            // 'data' => $data,
        ]);
    }

}