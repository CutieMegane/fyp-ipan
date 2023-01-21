<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\traffic;
use App\Http\Controllers\Controller;
use App\Imports\TrafficImport;
use Maatwebsite\Excel\Facades\Excel;

class TrafficDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $traffic = traffic::paginate(50);
        return view('traffics.index',compact('traffic'));
        //return view('traffics.index');
    }

    public function import(Request $request)
    {
        // Excel::import(new TrafficImport, 'trafficdata.xlsx');
        Excel::import(new TrafficImport, $request->file->path());

        return redirect('/')->with('success', 'All good!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('traffics.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        traffic::create($request->all());
        return redirect()->route('traffics.index')->with('success','Table is successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(traffic $traffic)
    {
        return view('traffics.show',compact('traffic'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(traffic $traffic)
    {
        return view('traffics.edit',compact('traffic'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, traffic $traffic)
    {
        $traffic->update($request->all());
        return redirect()->route('traffics.index')->with('success','Table updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(traffic $traffic)
    {
        $traffic->delete();
        return redirect()->route('traffics.index')->with('success','Table deleted successfully');
    }
}
