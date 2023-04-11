<?php

namespace App\Http\Controllers;

use App\Models\dataview;
use Illuminate\Http\Request;

class DataViewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dataview.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(dataview $dataview)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(dataview $dataview)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, dataview $dataview)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(dataview $dataview)
    {
        //
    }
}
