<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\traffic;

class trafficChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $weee = [
            traffic::where('DateAndTime','like', '2017%')
            ->where('Junction','1')->sum('Vehicles'),
            traffic::where('DateAndTime','like', '2017%')
            ->where('Junction','2')->sum('Vehicles'),
            traffic::where('DateAndTime','like', '2017%')
            ->where('Junction','3')->sum('Vehicles'),
            traffic::where('DateAndTime','like', '2017%')
            ->where('Junction','4')->sum('Vehicles')
        ];
        return $this->chart->barChart()
            ->setTitle('Traffic Junction vehicles count in 2017.')
            ->setSubtitle('Number of Vehicles.')
            ->addData('Junction', $weee)
            ->setXAxis(['1', '2', '3', '4']);
    }
}
