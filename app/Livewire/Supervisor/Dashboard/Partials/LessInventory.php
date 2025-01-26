<?php

namespace App\Livewire\Supervisor\Dashboard\Partials;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use App\Models\KitchenStock;

class LessInventory extends Component
{
    use WithPagination, WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $data = KitchenStock::with('product') // جلب بيانات المنتج المرتبطة
                ->orderBy('quantity', 'asc') // ترتيب المنتجات تصاعدياً حسب الكمية
                ->take(5) // أخذ أقل 5 منتجات فقط
                ->get();

        return view('supervisor.dashboard.partials.less-inventory',[
            'data' => $data,
        ]);
    }

}