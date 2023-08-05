@extends('new.template')

@section('content')
    <div class="container">
        @if ($message = Session::get('message'))
            <div class="alert alert-danger">
                <p>{{ $message }}</p>
            </div>
        @endif

        <form action="{{ route('new.analyze') }}" method="POST">
            @csrf
            @method('POST')

            <div class="container">
                <div class="row mt-3">
                    <div class="col">
                        <label for="start">Start Date</label>
                        <input type="number" class="form-control" min="1900" max="2099" step="1" value="2018"
                            id="start" name="start" />

                    </div>
                    <div class="col">
                        <label for="end">End Date</label>
                        <input type="number" class="form-control" min="1900" max="2099" step="1"
                            value="2023" id="end" name="end" />
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label for="junc">Injury Type</label>
                        <select class="form-select" required aria-label="Please Select Injury Type" name="injuryType">
                            <option value="0">None</option>
                            <option value="all">All</option>
                            <option value="1">Fatal</option>
                            <option value="2">Incapacitating</option>
                            <option value="3">No Injury/Unknown</option>
                            <option value="4">Non-Incapacitating</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label for="junc">Collision Type</label>
                        <select class="form-select" required aria-label="Please Select Collision Type" name="collisionType">
                            <option value="0">None</option>
                            <option value="all">All</option>
                            <option value="1">1-Car</option>
                            <option value="2">2-Cars</option>
                            <option value="3">3-Cars</option>
                            <option value="4">Mopped/Motorcycles</option>
                            <option value="5">Pedestrian</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label for="junc">Weekend/Weekday</label>
                        <select class="form-select" required aria-label="Please Select Weekend/Weekday" name="Weekend">
                            <option value="1">Weekend</option>
                            <option value="2">Weekday</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label for="pfSearch">Primary Factor</label>
                        <input type="text" class="form-control" value="" id="pfSearch" name="pfSearch" />
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label for="opr">Calculation</label>
                        <select class="form-select" aria-label="Please Select Operation" id="opr" name="opr">
                            <option value="sum">Sum</option>
                            <option value="avg">Average</option>
                            <option value="count">Count</option>
                            <option value="max">Max</option>
                            <option value="min">Min</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <button type="submit"
                            class="position-absolute top-50 start-50 translate-middle-x btn btn-primary d-flex">Analyse</button>
                    </div>
                </div>
            </div>
    </div>
    </form>
    </div>
@endsection
