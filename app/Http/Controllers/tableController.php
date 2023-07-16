<?php

namespace App\Http\Controllers;

use App\Models\table;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Exception;


class tableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tb = table::all();
        return view("table.index", compact('tb'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("table.up");
    }

    public function create2(Request $req){
        $hello = array();
        if ($req->file != null){
            try{
                $in = IOFactory::load($req->file->path());
            } catch (Exception $e){
                return redirect()->route('table.create')->with('message', 'Spreadsheet error. Please check uploaded files.'); 
            }
            $data = $in->getActiveSheet();
            $col = $data->getHighestColumn();
            $hello['colCount'] = 0;

            for ($x = 'A'; $x <= $col; $x++){
                $hello['colCount']++;
                $hello['col'.$hello['colCount']] = $data->getCell($x . '1')->getValue();
            }

            if ($hello['colCount'] < 2)
                return redirect()->route('table.create')->with('message', 'Really, good job'); 
            $hello['file'] = storage_path("app/".$req->file->store('tmp'));
            return view('table.up2', ['output' => $hello]);
        } else return redirect()->route('table.create') ->with('message', 'Good job');      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $in = IOFactory::load($req->upld);
        $tName = tableController::rngString(30);
        $deets = array();
        
        //Loop details to store in model
        for ($r = 1; $r <= $req->colCount; $r++){
            $pos = 'col'.$r.'name';
            $posT = 'col'.$r.'type';
            $deets[$pos] = $req->$pos;
            $deets[$posT] = $req->$posT;
        }
        $sr = serialize($deets);
        
        //Excel table builder
        Schema::create($tName, function (Blueprint $table) use ($req){
            $table -> id();
            for($i = 1; $i <= $req->colCount; $i++){
                $q1 = 'col'.$i;
                $q2 = 'col'.$i.'type';
                $type = $req->$q2;
                $table->$type($q1)->nullable(); //to ensure no error while processing malformed data
            }
            $table->timestamps();
        });

        //Metadata about tables
        table::create([
            'tableName' => $req->tableName,
            'tableDBName' => $tName,
            'tableDesc' => $req->tableDesc,
            'colCount' => $req->colCount,
            'details' => $sr,
        ]);

        //Start import
        $sheet = $in->getActiveSheet();
        $colH = $sheet->getHighestColumn();
        $rowH = $sheet->getHighestRow();

        for ($row = 2; $row <= $rowH; $row++){
            $val = array();
            $j = 1;
            for ($col = 'A'; $col <= $colH; $col++){
                $val['col'.$j] = $sheet->getCell($col.$row)->getValue();
                $j++;
            }
            DB::table($tName)->insert($val);
        }

        unlink($req->upld); //Delete temp files
        return redirect()->route('table.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\table  $table
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,table $table)
    {
        //dd($request);
        if($request->charts)
            $ct = 1;
        else
            $ct = 0;
        $data = DB::table($table->tableDBName)->paginate(25);
        $deets = unserialize($table->details);
        $colCount = $table->colCount;
        $chart = array();
        $o2 = 0;
        $chart2 = 0;
        $title = 0;
        $reason = null;

        if ($ct){
            if($request->opt == 2){
                $start = '2015-11-01 00:00:00';
                $end = '2015-11-01 23:00:00';
                $query = DB::table($table->tableDBName)->whereBetween('col1', [$start, $end])->where('col2', '=', '2')->get();
                $where = DB::table($table->tableDBName)->whereBetween('col1', [$start, $end])->where('col2', '=', '2')->get();
                $max = DB::table($table->tableDBName)->whereBetween('col1', [$start, $end])->where('col2', '=', '2')->max('col3');
                $when = DB::table($table->tableDBName)->whereBetween('col1', [$start, $end])->where('col2', '=', '2')->where('col3', '=', $max)->get();
                $when2 = $when[0]->col1;
                $where2 = $where[0]->col2;
                $chart = $query->pluck('col1')->toArray();
                $chart2 = $query->pluck('col3')->toArray();
                $o2 = 1;
                $reason = "The most busiest time is at $when2 with count of $max vehicles at junction $where2";
            }
            else if($request->opt == 3){
                $start = '08:00:00';
                $end = '10:00:00';
                $query = DB::table($table->tableDBName)->whereRaw('TIME(col1) BETWEEN ? AND ?', [$start, $end])->where('col2', '=', '1')->get();
                $avg = DB::table($table->tableDBName)->whereRaw('TIME(col1) BETWEEN ? AND ?', [$start, $end])->where('col2', '=', '1')->avg('col3');
                $where = DB::table($table->tableDBName)->whereRaw('TIME(col1) BETWEEN ? AND ?', [$start, $end])->where('col2', '=', '1')->get();
                $where2 = $where[0]->col2;
                $chart = $query->pluck('col1')->toArray();
                $chart2 = $query->pluck('col3')->toArray();
                $o2 = 1;
                $reason = "The average number of vehicles usage at junction $where2 from 2015 to 2017 on 8-10AM is $avg";
            } else {
            $chart['1'] = DB::table($table->tableDBName)->select('col1')->where('col2', '=', '1')->sum('col3');
            $chart['2'] = DB::table($table->tableDBName)->select('col1')->where('col2', '=', '2')->sum('col3');
            $chart['3'] = DB::table($table->tableDBName)->select('col1')->where('col2', '=', '3')->sum('col3');
            $chart['4'] = DB::table($table->tableDBName)->select('col1')->where('col2', '=', '4')->sum('col3');
            $title = "Sum of Vehicle in Juntion";
            $reason = "The most used junction is 1";
            }
        }
        return view('table.show')->with(['on' => $ct, 'o2' => $o2, 'details' => $deets, 'db' => $data, 'colCount' => $colCount, 'chart' => $chart, 'chart2' => $chart2, 't' => $table, 'reason' => $reason, 'title' => $title]);
    }



    public function analytic(Request $request)
    {
        return view ('table.analytic');
    }
    public function analyse(Request $request)
    {
        $data1 = $request->input('data1');
        $data2 = $request->input('data2');
        $data3 = $request->input('data3');
        return view('table.analytic')->with(['dt1' => $data1, 'dt2' => $data2, 'dt3' => $data3]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\table  $table
     * @return \Illuminate\Http\Response
     */
    public function edit(table $table)
    {
        return view('table.edit',compact('table'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\table  $table
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, table $table)
    {
        $table->update($request->all());
        return redirect()->route('table.index')->with('success','Row updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\table  $table
     * @return \Illuminate\Http\Response
     */
    public function destroy(table $table)
    {
        Schema::dropIfExists($table->tableDBName);
        $table->delete();
        return redirect()->route('table.index')->with('message', 'Table nuked');  
    }

    private function rngString($n)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }

    
}
