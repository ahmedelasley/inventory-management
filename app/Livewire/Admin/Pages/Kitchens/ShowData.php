<?php

namespace App\Livewire\Admin\Pages\Kitchens;

use Livewire\Component;
use App\Models\Supervisor;
use App\Models\Kitchen;
use App\Models\KitchenStock;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;

use App\Exports\KitchensExport;
use App\Exports\InventoryKitchenExport;
use App\Imports\KitchensImport;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\WithFileUploads;
// use Maatwebsite\Excel\Excel as ExcelType;
use Mpdf\Mpdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
class ShowData extends Component
{
    use LivewireAlert, WithPagination, WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $field = 'name';
    public $paginate;
    public $id;


    protected function queryString()
    {
        return [
            'search' => [
                'except' => '',
                'as' => 'q',
            ],
            'paginate' => [
                'except' => 1,
            ],
        ];
    }

    public function mount()
    {
        // $this->data->where($this->field, 'like', '%' . $this->search . '%')->latest()->paginate($this->paginate);
        $this->paginate = getSetting('pagination');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function updatingPaginate()
    {
        $this->resetPage();
    }

    public function searchField($searchField)
    {
        $this->field = $searchField;
    }




    public function exportExcel()
    {
        // Alert 
        showAlert($this, 'success', __('Downloading Data Successfully'));


        $kitchenName = Kitchen::find($this->id)->name;

        $fileName = 'Inventory ( '. $kitchenName . ' ) '. Carbon::now()->format('Y-m-d H-i-s a') . '.xlsx';


        return Excel::download(new InventoryKitchenExport($this->id), $fileName);

        // (new InventoryKitchenExport($this->id))->queue($fileName);

        // Excel::queue(new InventoryKitchenExport($this->id), 'exports/' . $fileName, 'public')
        //     ->chain([
        //         function () use ($fileName) {
        //             $downloadUrl = Storage::disk('public')->url('exports/' . $fileName);

        //             // إطلاق حدث للواجهة
        //             // $this->dispatch('download-file', ['url' => $downloadUrl]);
        //             $this->dispatch('download-file', url: $downloadUrl);

        //         }
        // ]);


    }
    public function exportPDF()
    {
        // Alert 
        showAlert($this, 'success', __('Downloading Data Successfully'));

        $kitchenName = Kitchen::find($this->id)->name;

        $fileName = 'Inventory ( '. $kitchenName . ' ) '. Carbon::now()->format('Y-m-d H-i-s a') . '.pdf';

        return Excel::download(new InventoryKitchenExport($this->id), $fileName, \Maatwebsite\Excel\Excel::MPDF);
        
    }




    


    public function render()
    {
        $data = KitchenStock::with(['product', 'kitchen'])->ofKitchen($this->id);
        if ($this->field == 'name') {
            $data = $data->whereHas('product', function ($query) { $query->where('name', 'like', '%' . $this->search . '%'); });
        } else if ($this->field == 'code') {
            $data = $data->whereHas('product', function ($query) { $query->where('sku', 'like', '%' . $this->search . '%'); });
        } else {
            $data = $data->where($this->field, 'like', '%' . $this->search . '%');
         }        
         $data = $data->latest()->paginate($this->paginate);

        return view('admin.pages.kitchens.show-data', [
            'data' => $data,
        ]);    }
}
