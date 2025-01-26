<div class="col-lg-6 col-md-6 col-6 mb-4">
    <div class="card  h-100">
      <div class="card-body">
        <h5 class="card-title mb-0">Stocks of Orders Statistics {{ date('Y') }} </h5>
        {!! $barChartOrders->render() !!}
      </div>
    </div>

</div>