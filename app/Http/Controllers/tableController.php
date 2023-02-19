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
    public function show(table $table)
    {
        $data = DB::table($table->tableDBName)->get();
        $deets = unserialize($table->details);
        //$table = compact('table');
        $colCount = $table->colCount;
        return view('table.show')->with(['details' => $deets, 'db' => $data, 'colCount' => $colCount]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\table  $table
     * @return \Illuminate\Http\Response
     */
    public function edit(table $table)
    {
        //
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
        //
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
