@extends('new.template')

@section('content')
    <div class="container text-center">
        <div class="row">
            <div class="col">
            </div>
            <div class="col">
                <h1><strong>Welcome To Road Data Analysis with
                        Data Visualization</strong></h1>
            </div>
            <div class="col">
            </div>
        </div>
    </div>
    <div class="container text-center">
        <div class="row">
            <div class="col">
            </div>
            <div class="col">
                <p>This system <strong>(Road Data Analysis with Visualization Feature)</strong> analyzes road traffic raw
                    data to provide
                    useful road traffic information to users <i>(city and transportation agencies)</i> for traffic
                    management
                    purposes.</p>
            </div>
            <div class="col">
            </div>
        </div>
    </div>
    <div class="container text-center">
        <div class="row">
            <div class="col">
            </div>
            <div class="col">

            </div>
            <div class="col">
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col">
                    <label for="junc">Data Charts</label>
                    <select  onchange="location = this.options[this.selectedIndex].value;" class="form-select" required aria-label="Data Chart" name="homeCharts" id="homeCharts">
                        <option value="/home/?c=1">Number of Accidents against Injury Type</option>
                        <option value="/home/?c=2">Number of Accidents against Year</option>
                        <option value="/home/?c=3">Count Injury Type Against Colision Type</option>
                        <option value="/home/?c=4">Count Injury Type Against Injury Type</option>
                        <option value="/home/?c=5">No of Injury Type Against Colision Type</option>
                        <option value="/home/?c=6">Count of Primary Factor Against Primary Factor</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="card">
                <div class="card-body">
                    @include('new.chart')
                </div>
            </div>
        </div>
    @endsection
