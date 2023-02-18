<?php

namespace App\Http\Controllers;

use App\Models\table;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

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
            $in = IOFactory::load($req->file->path());
            $data = $in->getActiveSheet();
            $col = $data->getHighestColumn();
            $hello[] = 0;

            for ($x = 'A'; $x <= $col; $x++){
                $val = $data->getCell($x.'1')->getValue();
                $hello[] = $val;
                $hello[0]++;
            }
            dd($hello);
        } else return redirect()->route('table.create') ->with('message', 'Good job');      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\table  $table
     * @return \Illuminate\Http\Response
     */
    public function show(table $table)
    {
        //
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
        //
    }
}
