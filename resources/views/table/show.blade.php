@extends('layouts.template')

@section('content')
    <div class="card">
        <main class="card">
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <div class="btn-group ps-3">
                    <a href="{{ route('table.show', $t) }}?charts=0" class="btn btn-outline-danger">Chart off</a>
                    <a href="{{ route('table.show', $t) }}?charts=1" class="btn btn-success">Chart on</a>
                </div>
                @if ($on)
                    <div class="btn-toolbar mb-2 mb-md-0 pe-2">
                        <div class="btn-group me-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Filter
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li>
                                    <a class="dropdown-item" href="{{ route('table.show', $t) }}?charts=1&opt=1">Junction</a></li>
                                <li><a class="dropdown-item" href="{{ route('table.show', $t) }}?charts=1&opt=2">Date And Time</a></li>
                                <li><a class="dropdown-item" href="{{ route('table.show', $t) }}?charts=1&opt=3">Number of Vehicles</a></li>
                            </ul>
                        </div>
                    </div>
                @endif
            </div>
            @if ($on)
                <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>
                <label class="form-label" for="customRange1">Example range</label>
                <div class="range">
                    <input type="range" class="form-range" id="customRange1" />
                </div>
            @endif
        </main>

        {!! $db->links() !!}
        <table class="table table-striped" style="width:100%">
            <tr>
                @for ($x = 1; $x <= $colCount; $x++)
                    <th>{{ $details['col' . $x . 'name'] }}</th>
                @endfor
                {{-- <td>Action</td>  --}}
            </tr>
            @foreach ($db as $d)
                <tr>
                    @for ($x = 1; $x <= $colCount; $x++)
                        <?php $str = 'col' . $x; ?>
                        <td>{{ $d->$str }}</td>
                    @endfor
                    {{-- <td><a class="btn btn-outline-secondary" href="{{ route('table.edit', $d->id) }}">Edit</a></td> --}}

                </tr>
            @endforeach
        </table>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"
        integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"
        integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous">
    </script>
    @if ($on)
        <script>
            const ctx = document.getElementById('myChart');
            var x = @json($chart);
            var title = 'Number';
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: Object.keys(x),
                    datasets: [{
                        label: title,
                        data: Object.values(x),
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
@endsection
