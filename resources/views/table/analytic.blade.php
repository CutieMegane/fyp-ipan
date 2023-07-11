@extends('layouts.template')

@section('content')
    @if ($message = Session::get('message'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
    @endif

<form action="{{ route ('table.analyse')}}" method="PUT">
    @csrf
    @method('PUT')

        <div class="container">
            <div class="row">
            <div class="col">
                <label for="">Date</label>
                <select class="form-select" aria-label="Default select example" name="data1">
                    <option value="1">2015</option>
                    <option value="2">2016</option>
                    <option value="3">2017</option>
                </select>
            </div>
            <div class="col">
                <label for="">Junction</label>
                <select class="form-select" aria-label="Default select example" name="data2">
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                    <option value="4">Four</option>
                </select>
            </div>
            </div>
            <div class="row">
                <div class="col">
                <label for="">Calculation</label>
                <select class="form-select" aria-label="Default select example" name="data3">
                    <option value="1">Sum</option>
                    <option value="2">Average</option>
                </select>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col"></div>
                <div class="col">
                    <div>
                        <button type="submit" class="btn btn-primary">Analyse</button>
                    </div>         
                </div>
            </div>
        </div>
</form>
@endsection
