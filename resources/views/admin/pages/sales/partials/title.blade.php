<div class="card mb-3 p-2">

    <div class="d-flex justify-content-between">
        <div>
            <h5 class="fw-bolder fs-5 d-inline">Sale </h5> [ {{ $sale->code }} ]
            @if($sale->status == 'Open')
                <span class="badge bg-primary ms-5">{{ $sale->status }}  <i class='bx bx-lock-open'></i></span>
            @else
                <span class="badge bg-dark ms-5">{{ $sale->status }}  <i class='bx bx-lock'></i></span>
            @endif
        </div>
        <div>
            <a class="btn btn-sm btn-outline-primary" href="javascript:void(0);" onclick="openPrintReceipt({{ $sale->id }})" ><i class='bx bx-printer'></i></a>

            <script type="text/javascript">
                function openPrintReceipt(id) {
                    window.open(
                        "{{ URL::to('admin/sales/print/sale/') }}/" + id ,
                        "_blank",
                        "toolbar=yes,scrollbars=yes,resizable=yes,top=200,left=500,width=800,height=800"
                    ).print();
                }
            </script>
            @if($sale->status == 'Open')
                @if($sale->type == 'Pending')
                    <a class="btn btn-sm btn-success" href="javascript:void(0);"
                        wire:click.prevent="$dispatch('saleUpdate', { id: {{ $sale->id }} })"
                    >
                        <i class='bx bx-edit-alt'></i>
                    </a>
                    
                    
                    <a class="btn btn-sm btn-primary" href="javascript:void(0);"
                        wire:click.prevent="$dispatch('saleSave', { id: {{ $sale->id }} })"
                    >
                        <i class='bx bx-save'></i>
                    </a>
                @endif
            @endif
            
            @if($sale->status == 'Open' && $sale->type == 'Pending')

                <a class="btn btn-sm btn-danger" href="javascript:void(0);"
                    wire:click.prevent="$dispatch('saleDelete', { id: {{ $sale->id }} })"
                >
                    <i class="bx bx-trash me-1"></i>
                </a>
                @livewire('admin.pages.sales.partials.delete', ['sale' => $sale], key('sale-delete-'.time()))
            @endif

            @livewire('admin.pages.sales.partials.edit', ['sale' => $sale], key('sale-edit-'.time()))
            
            @livewire('admin.pages.sales.partials.save', ['sale' => $sale], key('sale-save-'.time()))
            
        </div>
    </div>
</div>