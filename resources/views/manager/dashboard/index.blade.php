@extends('manager.layouts.master')

@section('content')

    @livewire('manager.dashboard.partials.statiscs.card-statiscs')

    {{-- <div class="row">
        @livewire('manager.dashboard.partials.welcome')
        @livewire('manager.dashboard.partials.chart-pie-inventory')
        @livewire('manager.dashboard.partials.card-statiscs')
    </div>
    <div class="row">
        @livewire('manager.dashboard.partials.chart-bar-warehouses')
        @livewire('manager.dashboard.partials.inventory-warehouses')
        @livewire('manager.dashboard.partials.chart-bar-kitchens')
        @livewire('manager.dashboard.partials.inventory-kitchens')

    </div> --}}
              
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@endsection