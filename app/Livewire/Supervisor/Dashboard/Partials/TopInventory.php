<?php

namespace App\Livewire\Supervisor\Dashboard\Partials;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use App\Models\KitchenStock;

class TopInventory extends Component
{
    use WithPagination, WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $data = KitchenStock::with('product')->ofKitchen(Auth::guard('supervisor')->user()->kitchen->id) // جلب بيانات المنتج المرتبطة
                ->orderBy('quantity', 'desc') // ترتيب المنتجات تصاعدياً حسب الكمية
                ->take(5) // أخذ أقل 5 منتجات فقط
                ->get();

        return view('supervisor.dashboard.partials.top-inventory',[
            'data' => $data,
        ]);
    }

}