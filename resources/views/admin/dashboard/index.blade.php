@extends('admin.layouts.master')

@section('content')

    @livewire('admin.dashboard.partials.statiscs.card-statiscs')

    {{-- <div class="row">
        @livewire('admin.dashboard.partials.welcome')
        @livewire('admin.dashboard.partials.chart-pie-inventory')
        @livewire('admin.dashboard.partials.card-statiscs')
    </div>
    <div class="row">
        @livewire('admin.dashboard.partials.chart-bar-warehouses')
        @livewire('admin.dashboard.partials.inventory-warehouses')
        @livewire('admin.dashboard.partials.chart-bar-kitchens')
        @livewire('admin.dashboard.partials.inventory-kitchens')

    </div> --}}
              
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@endsection