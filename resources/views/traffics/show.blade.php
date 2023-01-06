@extends('layouts.template')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Route Detail</h2>
            </div>
        </div>
    </div>
   
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>DateTime:</strong>
                {{ $traffic->DateTime}}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Junction:</strong>
                {{ $traffic->Junction}}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
                <strong>Vehicles:</strong>
                {{ $traffic->Vehicles}}
            </div>
        </div>
        <div class="form-group">
            <strong>ID:</strong>
            {{ $traffic->number}}
        </div>
    </div>
        <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('traffics.index') }}"> Back</a>
        </div>
    </div>
@endsection