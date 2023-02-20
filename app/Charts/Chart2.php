<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;

class Chart2
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $weee = [
            DB::table('6nsokhutb4g401fpl6avdrtibcexfx')->where('col1', 'like', '2017%')->where('col2','like', '1')->sum('col3'),
            DB::table('6nsokhutb4g401fpl6avdrtibcexfx')->where('col1', 'like', '2017%')->where('col2', 'like', '2')->sum('col3'),
            DB::table('6nsokhutb4g401fpl6avdrtibcexfx')->where('col1', 'like', '2017%')->where('col2', 'like', '3')->sum('col3'),
            DB::table('6nsokhutb4g401fpl6avdrtibcexfx')->where('col1', 'like', '2017%')->where('col2', 'like', '4')->sum('col3'),
        ];

        return $this->chart->barChart()
            ->setTitle('Traffic Junction vehicles in 2017.')
            ->setSubtitle('Number of Vehicles.')
            ->addData('Junction', $weee)
            ->setXAxis(['1', '2', '3', '4']);
    }
}
