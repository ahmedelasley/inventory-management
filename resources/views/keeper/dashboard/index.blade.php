@extends('keeper.layouts.master')

@section('content')
    <div class="row">
        @livewire('keeper.dashboard.partials.welcome')
        @livewire('keeper.dashboard.partials.card-statiscs')
        @livewire('keeper.dashboard.partials.less-inventory')
        @livewire('keeper.dashboard.partials.chart')
        @livewire('keeper.dashboard.partials.top-inventory')

    </div>
              
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@endsection