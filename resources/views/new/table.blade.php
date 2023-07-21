@extends('new.template')

@section('content')
    @if ($chartOn)
        <div class="container">
            @push('scripts')
                <script >
                    var gg = {{$chartOn}};
                    var chartType = 'bar';
                    var title = 'Hello there';
                    var x_label = 'Color';
                    var y_label = 'Votes count';
                    var legend_label = y_label;
                    var x_value = ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'];
                    var data = [12, 19, 3, 5, 2, 3];
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
        </div>
    </div>
@endsection
