<?php

namespace App\Http\Controllers;

use App\Models\traffic;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Exception;

class trafficAnalyze extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $req)
    {

        $chartData = null;
        $chartData2 = null;
        switch ($req->c) {
            case '2':
                //code to be executed if n=label1;
                $chartData = [
                    'chartType' => 'line',
                    'title' => 'Number of Accidents against Year',
                    'x_label' => 'Year',
                    'y_label' => "Number of Accidents",
                    'x_value' => ['2018', '2019', '2020', '2021', '2022', '2023'],
                    'data' => [43, 49, 63, 59, 94, 303],
                ];
                break;
            case '3':
                //code to be executed if n=label2;
                $chartData = [
                    'chartType' => 'bar',
                    'title' => 'Count Injury Type Against Colision Type ',
                    'x_label' => 'Colision Type',
                    'y_label' => "Number of Injury",
                    'x_value' => ['1-Car', '2-Car', '3+Car', 'Bus', 'Cyclist', 'Moped/Motorcycle', 'Pedestrian'],
                    'data' => [5010, 16722, 1375, 431, 296, 502, 394],
                ];
                break;
            case '4':
                //code to be executed if n=label3;
                $chartData = [
                    'chartType' => 'bar',
                    'title' => 'Injury Type Against Count Injury Type ',
                    'x_label' => 'Injury Type',
                    'y_label' => "Number of Injury",
                    'x_value' => ['Fatal', 'Incapacitating', 'Non-Incapacitating', 'No Injury/Unknown'],
                    'data' => [200, 800, 19525, 4359],
                ];
                break;
            case '5':
                //code to be executed if n=label3;
                $chartData = [
                    'chartType' => 'line',
                    'title' => 'No of Accidents Against Year by Weekday ',
                    'x_label' => 'Year',
                    'y_label' => "Number of Accident",
                    'x_value' => ['2018', '2019', '2020', '2021', '2022', '2023'],
                    'data' => [8, 4, 6, 2, 4, 6],
                ];
                $chartData2 = [
                    'chartType' => 'line',
                    'title' => 'No of Accidents Against Year by Weekend ',
                    'x_label' => 'Year',
                    'y_label' => "Number of Accident",
                    'x_value' => ['2018', '2019', '2020', '2021', '2022', '2023'],
                    'data' => [5, 5, 3, 2, 4, 2],
                ];
                break;
            case '6':
                //code to be executed if n=label3;
                $chartData = [
                    'chartType' => 'line',
                    'title' => 'Count InjuryType against Year  ',
                    'x_label' => 'Year',
                    'y_label' => "Number of Injury",
                    'x_value' => ['2018', '2019', '2020', '2021', '2022', '2023'],
                    'data' => [3121, 3074, 3270, 3269, 3335, 3456],
                ];
                $chartData2 = [
                    'chartType' => 'line',
                    'title' => 'Count InjuryType against Year ',
                    'x_label' => 'Year',
                    'y_label' => "Number of Injury",
                    'x_value' => ['2018', '2019', '2020', '2021', '2022', '2023'],
                    'data' => [865, 769, 854, 706, 707, 458],
                ];
                break;

            default:
                //code to be executed if n is different from all labels;
                $chartData = [
                    'chartType' => 'bar',
                    'title' => 'Number of Injury ',
                    'x_label' => 'Injury Type',
                    'y_label' => "Number of Injury",
                    'x_value' => ['Fatal', 'Incapacitating', 'Non-Incapacitating', 'No Injury/Unknown'],
                    'data' => [10, 30, 100, 50],
                ];
        }
        return view('new.home', compact('chartData', 'chartData2'));
    }

    /*
     * Initial page for upload the excel file
     */
    public function upload()
    {
        return view("new.upload");
    }

    /*
     * Initial page for upload the excel file
     */
    public function analyze(Request $req)
    {
        //handling both POST and GET in a function
        if ($req->isMethod('post')) {
            $tr = 0; //initialization
            $chartData = 0; //Chart variables
            $val = 0;


            //Operation sum
            if ($req->opr == 'sum') {
                $tr = [];
                if ($req->start && $req->end) {
                    if ($req->junc > 0 && $req->junc < 5) {
                        $val = traffic::where('junc', $req->junc)->whereBetween('date', [$req->start, $req->end])->sum('carCount');
                        $tr[$req->junc] = [
                            'date' => null,
                            'junc' => $req->junc,
                            'carCount' => $val,
                        ];
                        $chartData = [
                            'title' => 'Number of cars in ' . $req->junc . ' within ' . $req->start . ' and ' . $req->end,
                            'x_label' => 'Junction',
                            'y_label' => "Number of cars",
                            'x_value' => $req->junc,
                            'data' => $val,
                        ];
                    } else {
                        $val = array();
                        for ($i = 1; $i < 5; $i++) {
                            $val[] = traffic::where('junc', $i)->whereBetween('date', [$req->start, $req->end])->sum('carCount');
                            $tr[$i] = [
                                'date' => null,
                                'junc' => $i,
                                'carCount' => $val[$i - 1],
                            ];
                        }
                        $chartData = [

                            'title' => 'Number of cars in all junction within ' . $req->start . ' and ' . $req->end,
                            'x_label' => 'Junction',
                            'y_label' => "Number of cars",
                            'x_value' => [1, 2, 3, 4],
                            'data' => $val,
                        ];
                    }
                }
            } else if ($req->opr == 'avg') { //Operation average
                $tr = [];
                if ($req->start && $req->end) {
                    if ($req->junc > 0 && $req->junc < 5) {
                        $val = traffic::where('junc', $req->junc)->whereBetween('date', [$req->start, $req->end])->avg('carCount');
                        $tr[$req->junc] = [
                            'date' => null,
                            'junc' => $req->junc,
                            'carCount' => $val,
                        ];
                        $chartData = [
                            'title' => 'Average number of cars in all junction within ' . $req->start . ' and ' . $req->end,
                            'x_label' => 'Junction',
                            'y_label' => "Number of cars",
                            'x_value' =>  $req->junc,
                            'data' => $val,
                        ];
                    } else {
                        $val = array();
                        for ($i = 1; $i < 5; $i++) {
                            $val[] = traffic::where('junc', $i)->whereBetween('date', [$req->start, $req->end])->avg('carCount');
                            $tr[$i] = [
                                'date' => null,
                                'junc' => $i,
                                'carCount' => $val[$i - 1],
                            ];
                        }
                        $chartData = [
                            'title' => 'Average number of cars in all junction within ' . $req->start . ' and ' . $req->end,
                            'x_label' => 'Junction',
                            'y_label' => "Number of cars",
                            'x_value' => [1, 2, 3, 4],
                            'data' => $val,
                        ];
                    }
                }
            } else if ($req->opr == 'count') { // Operation count
                $tr = [];
                if ($req->start && $req->end) {
                    if ($req->junc > 0 && $req->junc < 5) {
                        $count = traffic::where('junc', $req->junc)->whereBetween('time', [$req->start, $req->end])->count();

                        $tr[$req->junc] = [
                            'date' => null,
                            'junc' => $req->junc,
                            'recordCount' => $count,
                        ];

                        $chartData = [
                            'title' => 'Number of records in ' . $req->junc . ' within ' . $req->start . ' and ' . $req->end,
                            'x_label' => 'Junction',
                            'y_label' => 'Number of Records',
                            'x_value' => $req->junc,
                            'data' => $count,
                        ];
                    } else {
                        $counts = [];
                        for ($i = 1; $i < 5; $i++) {
                            $count = traffic::where('junc', $i)->whereBetween('date', [$req->start, $req->end])->count();

                            $tr[$i] = [
                                'date' => null,
                                'junc' => $i,
                                'recordCount' => $count,
                            ];

                            $counts[] = $count;
                        }

                        $chartData = [
                            'title' => 'Number of records in all junctions within ' . $req->start . ' and ' . $req->end,
                            'x_label' => 'Junction',
                            'y_label' => 'Number of Records',
                            'x_value' => [1, 2, 3, 4],
                            'data' => $counts,
                        ];
                    }
                }
            } else if ($req->opr == 'max') { // Operation max
                $tr = [];
                if ($req->start && $req->end) {
                    if ($req->junc > 0 && $req->junc < 5) {
                        $maxValue = traffic::where('junc', $req->junc)->whereBetween('date', [$req->start, $req->end])->max('carCount');

                        $tr[$req->junc] = [
                            'date' => null,
                            'junc' => $req->junc,
                            'maxCarCount' => $maxValue,
                        ];

                        $chartData = [
                            'title' => 'Maximum number of cars in ' . $req->junc . ' within ' . $req->start . ' and ' . $req->end,
                            'x_label' => 'Junction',
                            'y_label' => 'Maximum Number of Cars',
                            'x_value' => $req->junc,
                            'data' => $maxValue,
                        ];
                    } else {
                        $maxValues = [];
                        for ($i = 1; $i < 5; $i++) {
                            $maxValue = traffic::where('junc', $i)->whereBetween('date', [$req->start, $req->end])->max('carCount');

                            $tr[$i] = [
                                'date' => null,
                                'junc' => $i,
                                'maxCarCount' => $maxValue,
                            ];

                            $maxValues[] = $maxValue;
                        }

                        $chartData = [
                            'title' => 'Maximum number of cars in all junctions within ' . $req->start . ' and ' . $req->end,
                            'x_label' => 'Junction',
                            'y_label' => 'Maximum Number of Cars',
                            'x_value' => [1, 2, 3, 4],
                            'data' => $maxValues,
                        ];
                    }
                }
            } else if ($req->opr == 'min') { // Operation min
                $tr = [];
                if ($req->start && $req->end) {
                    if ($req->junc > 0 && $req->junc < 5) {
                        $minValue = traffic::where('junc', $req->junc)->whereBetween('date', [$req->start, $req->end])->min('carCount');

                        $tr[$req->junc] = [
                            'date' => null,
                            'junc' => $req->junc,
                            'minCarCount' => $minValue,
                        ];

                        $chartData = [
                            'title' => 'Minimum number of cars in ' . $req->junc . ' within ' . $req->start . ' and ' . $req->end,
                            'x_label' => 'Junction',
                            'y_label' => 'Minimum Number of Cars',
                            'x_value' => $req->junc,
                            'data' => $minValue,
                        ];
                    } else {
                        $minValues = [];
                        for ($i = 1; $i < 5; $i++) {
                            $minValue = traffic::where('junc', $i)->whereBetween('date', [$req->start, $req->end])->min('carCount');

                            $tr[$i] = [
                                'date' => null,
                                'junc' => $i,
                                'minCarCount' => $minValue,
                            ];

                            $minValues[] = $minValue;
                        }

                        $chartData = [
                            'title' => 'Minimum number of cars in all junctions within ' . $req->start . ' and ' . $req->end,
                            'x_label' => 'Junction',
                            'y_label' => 'Minimum Number of Cars',
                            'x_value' => [1, 2, 3, 4],
                            'data' => $minValues,
                        ];
                    }
                }
            } else { //No operation selected, get data without further filtering.
                if ($req->start && $req->end) {
                    if ($req->junc > 0 && $req->junc < 5)
                        $tr = traffic::where('junc', $req->junc)->whereBetween('date', [$req->start, $req->end])->paginate(20);
                    else
                        $tr = traffic::whereBetween('date', [$req->start, $req->end])->paginate(20);
                } else {
                    if ($req->junc > 0 && $req->junc < 5)
                        $tr = traffic::where('junc', $req->junc)->paginate(20);
                    else
                        $tr = traffic::paginate(20);
                }
            }
            //dd($tr);
            $return = compact('tr', 'chartData');
            return view('new.table', $return);
        } else {
            return view("new.analyze");
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $req)
    {
        $colCount = 0;
        $temp = array();

        //Filecheck sequence
        if ($req->file != null) {
            try {
                $in = IOFactory::load($req->file->path());
            } catch (Exception $e) {
                return redirect()->route('new.upload')->with('message', 'Spreadsheet error. Please check uploaded files.');
            }
            $data = $in->getActiveSheet();
            $col = $data->getHighestColumn();

            for ($x = 'A'; $x <= $col; $x++) {
                $colCount++;
            }

            if ($colCount < 2)
                return redirect()->route('new.create')->with('message', 'Column less than 2. Please check uploaded files.');
        } else
            return redirect()->route('new.create')->with('message', 'Good job');

        //Start import...
        $sheet = $in->getActiveSheet();
        $colH = $sheet->getHighestColumn();
        $rowH = $sheet->getHighestRow();

        for ($row = 2; $row <= $rowH; $row++) {
            $val = array();
            $j = 1;
            for ($col = 'B'; $col <= $colH; $col++) {
                $val[$j] = $sheet->getCell($col . $row)->getValue();
                $j++;
            }
            $temp[] = $val;
        }
        //dd($temp);
        //...to database via model
        foreach ($temp as $entry) {
            $tr = new traffic();
            $masa = 0;
            if ($entry[4] >= '1000') {
                $masa = substr($entry[4], 0, 2);
            } else if ($entry[4] == '0') {
                $masa = '00';
            } else {
                $masa = substr($entry[4], 0, 1);
            }
            $tr->time = Carbon::create($entry[1], $entry[2], $entry[3], $masa);
            if ($entry[5] == 'Weekend')
                $tr->weekend = 1;
            else
                $tr->weekend = 0;
            $tr->collisionType = $entry[6];
            $tr->injuryType = $entry[7];
            $tr->primaryFactor = $entry[8];
            $tr->reportedLocation = $entry[9];
            $tr->lat = $entry[10];
            $tr->long = $entry[11];
            $tr->save();
        }

        //Delete temp files
        unlink($req->file->path());
        return redirect()->route('new.table');
    }

    /**
     * Display a table that contain all the data
     */
    public function table(Request $request)
    {
        $tr = traffic::paginate(20);
        $chartData = null;
        return view('new.table', compact('tr', 'chartData'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(traffic $traffic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(traffic $traffic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, traffic $traffic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(traffic $traffic)
    {
        //
    }
}
