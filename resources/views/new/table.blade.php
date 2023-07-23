@extends('new.template')

@section('content')
    @if ($chartData)
        <div class="container">
            @push('scripts')
                <script>
                    var gg = "wp" //flowtesto

                    var bkend = JSON.parse('@json($chartData)');
                    //from Controller -> Blade in json
                    var chartType = bkend.chartType;
                    var title = bkend.title;
                    var x_label = bkend.x_label;
                    var y_label = bkend.y_label;
                    var x_value = bkend.x_value;
                    var data = bkend.data;
                </script>
                <script src="{{ asset('js/theChart.js') }}" defer></script>
            @endpush
            <canvas id="zeChat"></canvas>
        </div>
    @endif
    <div class="container">
        <div class="container btn-groups">
            @if ($tr instanceof \Illuminate\Pagination\LengthAwarePaginator)
                {!! $tr->links() !!}
            @endif
        </div>

        <div class="container">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Junction</th>
                        <th scope="col">Vehicle count</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($tr instanceof \Illuminate\Pagination\LengthAwarePaginator)
                        @foreach ($tr as $t)
                            <tr>
                                <th scope="row">{{ $t->date }}</th>
                                <td>{{ $t->junc }}</td>
                                <td>{{ $t->carCount }}</td>
                            </tr>
                        @endforeach
                    @else
                        @foreach ($tr as $t)
                            <tr>
                                <th scope="row">{{ $t['date'] }}</th>
                                <td>{{ $t['junc'] }}</td>
                                <td>{{ $t['carCount'] }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>

            </table>
            @json($chartData)
        </div>
    </div>
@endsection
