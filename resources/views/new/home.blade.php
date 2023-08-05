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
                <p>This system <strong>(Road Data Analysis with Visualization Feature)</strong> analyzes road traffic raw data to provide
                    useful road traffic information to users <i>(city and transportation agencies)</i> for traffic management
                    purposes.</p>
                    <p>Please click the link below to redirect to the analyze page</p>
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
                <a class="btn btn-primary" href="{{ route('new.analyze') }}" role="button">Page Analyze</a>
            </div>
            <div class="col">
            </div>
        </div>
    </div>
@endsection
