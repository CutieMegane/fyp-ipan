@extends('new.template')

@section('content')
    @if ($chartData)
        <div class="container">
            @push('scripts')
                <script>
                    var gg = "wp" //flowtesto

                    var bkend = JSON.parse('@json($chartData)');
                    //from Controller -> Blade in json
                    var chartType = 'bar';
                    var title = bkend.title;
                    var x_label = bkend.x_label;
                    var y_label = bkend.y_label;
                    var x_value = bkend.x_value;
                    var data = bkend.data;
                </script>
                <script src="{{ asset('js/theChart.js') }}" defer></script>
            @endpush
            <div width="700">
                <canvas class="my-4 w-100" id="zeChat" width="900" height="380"></canvas>
            </div>
            <select onchange="changeType(this)">
                <optgroup label="Select Chart"></optgroup>
                <option value="bar">Bar</option>
                <option value="line">Line</option>
                <option value="pie">Pie</option>
                <option value="radar">Radar</option>
            </select>
            <br>
            <br>
            <button onclick="download()">Download</button>
            <button onclick="downloadPDF()">PDF Download</button>

        </div>
        <br>
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
                        <th scope="col">Weekend</th>
                        <th scope="col">Collision Type</th>
                        <th scope="col">Injury Type</th>
                        <th scope="col">Primary Factor</th>
                        <th scope="col">reportedLocation</th>
                        <th scope="col">Latitude</th>
                        <th scope="col">Longlitude</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($tr instanceof \Illuminate\Pagination\LengthAwarePaginator)
                        @foreach ($tr as $t)
                            <tr>
                                <th scope="row">{{ $t->time }}</th>
                                <td>
                                    @if($t->weekend)
                                    Weekend
                                    @else
                                    Weekday
                                    @endif
                                </td>
                                <td>{{ $t->collisionType }}</td>
                                <td>{{ $t->injuryType }}</td>
                                <td>{{ $t->primaryFactor }}</td>
                                <td>{{ $t->reportedLocation }}</td>
                                <td>{{ $t->lat }}</td>
                                <td>{{ $t->long }}</td>
                            </tr>
                        @endforeach
                    @else
                        @foreach ($tr as $t)
                            <tr>
                                <th scope="row">{{ $t['time'] }}</th>
                                <td>
                                    @if($t['weekend'])
                                    WeekEnd
                                    @else
                                    Weekday
                                    @endif
                                </td>
                                <td>{{ $t['collisionType'] }}</td>
                                <td>{{ $t['injuryType'] }}</td>
                                <td>{{ $t['primaryFactor'] }}</td>
                                <td>{{ $t['reportedLocation'] }}</td>
                                <td>{{ $t['lat'] }}</td>
                                <td>{{ $t['long'] }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>

            </table>
            {{-- @json($chartData) --}}
        </div>
    </div>
@endsection
