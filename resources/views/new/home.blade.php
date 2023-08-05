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
                    <select class="form-select" required aria-label="Data Chart" name="homeCharts" id="homeCharts">
                        <option value="1">Count InjuryType against Year</option>
                        <option value="2">No Accidents Against Year by Primary Factor</option>
                        <option value="3">No of Accidents Against Year by Weekend</option>
                        <option value="4">No of Fatal Accidents by Reported Location Against Year</option>
                        <option value="5">No of Injury Type Against Colision Type</option>
                        <option value="6">Count of Primary Factor Against Primary Factor</option>
                        <option value="7">Injury Against Count Injury Type</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="card">
                <div class="card-body">
                    Chart PlaceHolder
                </div>
            </div>
        </div>
    @endsection
