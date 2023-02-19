<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\IReadFilter;

//use App\Models\dynamictable;

class dynamicPage extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$dynamic = dynamictable::all();
        return view('dynamics.index');

    }

    public function index2()
    {
        return view('dynamics.index2');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //dd($request);
        // $hello;
        dd($request);

        $insert = array();

        if ($request->col1 != null) $insert[] = $request->col1;
        if ($request->col2 != null) $insert[] = $request->col2;
        if ($request->col3 != null) $insert[] = $request->col3;
        if ($request->col4 != null) $insert[] = $request->col4;
        if ($request->col5 != null) $insert[] = $request->col5;
        if ($request->col6 != null) $insert[] = $request->col6;
        if ($request->col7 != null) $insert[] = $request->col7;
        if ($request->col8 != null) $insert[] = $request->col8;
        if ($request->col9 != null) $insert[] = $request->col9;
        if ($request->col10 != null) $insert[] = $request->col10;

        Schema::create($request->tableName, 
            function (Blueprint $table) use ($insert){
            $table->id();
            foreach($insert as $x)
                    $table->string($x);
            $table->timestamps();
        });
        return redirect()->route('dynamic.index2');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
