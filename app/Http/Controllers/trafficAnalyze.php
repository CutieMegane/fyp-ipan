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
        foreach($temp as $entry){
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
        return view('new.table', compact('tr'));
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
