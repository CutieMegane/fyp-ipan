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
    public function index()
    {
        return view('new.home');
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
            } 
            else if ($req->opr == 'count') {// Operation count
                $tr = [];
                if ($req->start && $req->end) {
                    if ($req->junc > 0 && $req->junc < 5) {
                        $count = traffic::where('junc', $req->junc)->whereBetween('date', [$req->start, $req->end])->count();

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
            } 
            else if ($req->opr == 'max') {// Operation max
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
            } 
            else if ($req->opr == 'min') {// Operation min
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
                            $minValue = traffic::where('junc', $i) ->whereBetween('date', [$req->start, $req->end])  ->min('carCount');

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
