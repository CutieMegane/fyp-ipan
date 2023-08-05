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

                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Filter
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li>
                                    <a class="dropdown-item" href="{{ route('table.show', $t) }}?charts=1&opt=1">Most used
                                        Junction</a>
                                </li>
                                <li><a class="dropdown-item" href="{{ route('table.show', $t) }}?charts=1&opt=2">2015.11.01
                                        24 Hours</a></li>
                                <li><a class="dropdown-item" href="{{ route('table.show', $t) }}?charts=1&opt=3">From 8 AM
                                        to 10 AM On Junction 1</a></li>
                            </ul>
                        </div>
                    </div>
                @endif
            </div>
            @if ($on)
                <div class="chartBox">
                    <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>
                    <br>
                    <select onchange="changeChart(this)">
                        <optgroup label="Select Chart"></optgroup>
                        <option value="bar">Bar</option>
                        <option value="line">Line</option>
                        <option value="pie">Pie</option>
                        <option value="radar">Radar</option>
                        <option value="doughnut">Doughnut</option>
                    </select>
                    <br>
                    <button onclick="download()">Download</button>
                    <button onclick="downloadPDF()">PDF Download</button>
                </div>
                <h3>{{ $reason }}</h3>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.9.359/pdf.min.js"
        integrity="sha512-U5C477Z8VvmbYAoV4HDq17tf4wG6HXPC6/KM9+0/wEXQQ13gmKY2Zb0Z2vu0VNUWch4GlJ+Tl/dfoLOH4i2msw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js"></script>
    @if ($on)
        <script>
            var x = @json($chart);
            var title = @json($title);
            // setup 
            const data = {
                @if ($o2)
                    labels: @json($chart),
                @else
                    labels: Object.keys(x),
                @endif
                datasets: [{
                    label: title,
                    @if ($o2)
                        data: @json($chart2),
                    @else
                        data: Object.values(x),
                    @endif

                    backgroundColor: [
                        'rgba(255, 26, 104, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(0, 0, 0, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 26, 104, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(0, 0, 0, 1)'
                    ],
                    borderWidth: 1
                }]
            };

            // config 
            const config = {
                type: 'bar',
                data,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            };
            // config2 
            const config2 = {
                type: 'line',
                data,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            };
            // config3 
            const config3 = {
                type: 'pie',
                data,
                options: {}
            };
            // config4 
            const config4 = {
                type: 'radar',
                data,
                options: {
                    scales: {

                    }
                }
            };
            // config5
            const config5 = {
                type: 'doughnut',
                data,
                options: {
                    scales: {

                    }
                }
            };

            // render init block
            let myChart = new Chart(
                document.getElementById('myChart'),
                config
            );

            function changeChart(chartType) {
                //console.log(chartType);

                console.log(chartType.value);


                if (chartType.value === 'bar') {
                    myChart.destroy();
                    myChart = new Chart(
                        document.getElementById('myChart'),
                        config
                    );
                }
                if (chartType.value === 'line') {
                    myChart.destroy();
                    myChart = new Chart(
                        document.getElementById('myChart'),
                        config2
                    );
                }

                if (chartType.value === 'pie') {
                    myChart.destroy();
                    myChart = new Chart(
                        document.getElementById('myChart'),
                        config3
                    );
                }

                if (chartType.value === 'radar') {
                    myChart.destroy();
                    myChart = new Chart(
                        document.getElementById('myChart'),
                        config4
                    );
                }

                if (chartType.value === 'doughnut') {
                    myChart.destroy();
                    myChart = new Chart(
                        document.getElementById('myChart'),
                        config5
                    );
                }

            }

            function download() {
                // create link to the image
                const imageLink = document.createElement('a');
                // create an image from the canvas
                const canvas = document.getElementById('myChart');
                // create a naming for the download imgae
                imageLink.download = 'canvas.png';
                // setting the quality of the image
                imageLink.href = canvas.toDataURL('image/png', 1);
                // execute image download function
                imageLink.click();
            }

            function downloadPDF() {
                const canvas = document.getElementById('myChart');
                // Create Image
                const canvasImage = canvas.toDataURL('image/jpeg', 1);
                console.log(canvasImage);
                // Image must go to pdf 

                let pdf = new jsPDF('landscape');
                pdf.setFontSize(20);
                pdf.addImage(canvasImage, 'JPEG', 15, 15, 280, 150);
                pdf.save('chart.pdf');
            }

            // Instantly assign Chart.js version
            const chartVersion = document.getElementById('chartVersion');
            chartVersion.innerText = Chart.version;
        </script>
    @endif
@endsection
