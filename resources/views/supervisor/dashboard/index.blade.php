@extends('supervisor.layouts.master')

@section('content')
    <div class="row">
        @livewire('supervisor.dashboard.partials.welcome')
        @livewire('supervisor.dashboard.partials.card-statiscs')
        @livewire('supervisor.dashboard.partials.less-inventory')
        @livewire('supervisor.dashboard.partials.chart')
        @livewire('supervisor.dashboard.partials.top-inventory')

    </div>
              
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@endsection