<?php

namespace App\Http\Controllers;

use App\Models\traffic;
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
                            'chartType' => 'pic',
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
                                'carCount' => $val[$i-1],
                            ];
                        }
                        $chartData = [
                            'chartType' => 'bar',
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
                    if ($req->junc > 0 && $req->junc < 5)
                    $tr[$req->junc] = [
                        'date' => null,
                        'junc' => $req->junc,
                        'carCount' => traffic::where('junc', $req->junc)->whereBetween('date', [$req->start, $req->end])->avg('carCount'),
                    ];
                    else {
                        for ($i = 1; $i < 5; $i++) {
                            $tr[$i] = [
                                'date' => null,
                                'junc' => $i,
                                'carCount' => traffic::where('junc', $i)->whereBetween('date', [$req->start, $req->end])->avg('carCount'),
                            ];
                        }
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
            for ($col = 'A'; $col <= $colH; $col++) {
                $val[$j] = $sheet->getCell($col . $row)->getValue();
                $j++;
            }
            $temp[] = $val;
        }
        //...to database via model
        foreach ($temp as $entry) {
            $tr = new traffic();
            $tr->date = $entry[1];
            $tr->junc = $entry[2];
            $tr->carCount = $entry[3];
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
