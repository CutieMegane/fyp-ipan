@extends ('layouts.template')

@section('content')
    @if ($message = Session::get('message'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="row">
                                <div class="col-8">
                                    <div class="number">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Number of Cars</p>
                                        <h5 class="font-weight-bolder"><?php echo(rand() ) ?></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="row">
                                <div class="col-8">
                                    <div class="number">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Number of Trucks</p>
                                        <h5 class="font-weight-bolder"><?php echo(rand() ) ?></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="row">
                                <div class="col-8">
                                    <div class="number">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Number of Motorcycles</p>
                                        <h5 class="font-weight-bolder"><?php echo(rand() ) ?></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="row">
                                <div class="col-8">
                                    <div class="number">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Number of Buses</p>
                                        <h5 class="font-weight-bolder"><?php echo(rand() ) ?></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lh-7 mb-lg-0 mb-4">
                <div class="card z-index-2 h-100">
                    <div class="card-header pb-0 pt-3 ng-transparent">
                        <h6 class="text-capatalize">Number of Vehicles</h6>
                        <p class="text-sm mb-0">
                            <i class="fa fa-arrow-up text success" aria-hidden="true"></i>
                            <span class="font-weight-bold">1% more</span>
                        </p>
                    </div>
                    <div class="card-body p-3">
                        <div class="chart">
                            <canvas id="chart-line" class="chart-canvas" height="300" width="532" style="display: block; box-sizing: border-box; height: 300px; width: 532.6px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection