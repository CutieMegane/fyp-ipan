
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
            <div width="700">
                <canvas class="my-4 w-100" id="zeChat" width="900" height="380"></canvas>
            </div>
            <br>
            <button onclick="download()">Download</button>
            <button onclick="downloadPDF()">PDF Download</button>
        </div>
        <br>
    @endif
    @if ($chartData2)
        <div class="container">
            @push('scripts')
                <script>

                    var bkend2 = JSON.parse('@json($chartData2)');
                    //from Controller -> Blade in json
                    var chartType2 = bkend2.chartType;
                    var title2 = bkend2.title;
                    var x_label2 = bkend2.x_label;
                    var y_label2 = bkend2.y_label;
                    var x_value2 = bkend2.x_value;
                    var data2 = bkend2.data;
                </script>
                <script src="{{ asset('js/theChart2.js') }}" defer></script>
            @endpush
            <div width="700">
                <canvas class="my-4 w-100" id="zeChat2" width="900" height="380"></canvas>
            </div>
            <br>
            <button onclick="download2()">Download</button>
            <button onclick="downloadPDF2()">PDF Download</button>
        </div>
        <br>
    @endif

