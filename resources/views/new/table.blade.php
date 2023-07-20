@extends('new.template')

@section('content')
    <div class="container">
        @if ($chartOn)
            <div class="container">
                <canvas id="zeChat"></canvas>
            </div>

                        
            <script>
                const ctx = document.getElementById('zeChat');

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                        datasets: [{
                            label: '# of Votes',
                            data: [12, 19, 3, 5, 2, 3],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>
        @endif
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
