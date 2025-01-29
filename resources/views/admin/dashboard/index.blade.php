@extends('admin.layouts.master')

@section('content')
    <div class="row">
        @livewire('admin.dashboard.partials.welcome')
        {{-- @livewire('admin.dashboard.partials.card-statiscs') --}}
        {{-- @livewire('admin.dashboard.partials.less-inventory')
        @livewire('admin.dashboard.partials.chart')
        @livewire('admin.dashboard.partials.top-inventory') --}}

    </div>
              
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@endsection