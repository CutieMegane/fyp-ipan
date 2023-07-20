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
                <div class="row">
                    <label for="start">Start Date</label>
                    <input type="date" id="start" name="start">
                    <label for="end">End Date</label>
                    <input type="date" id="end" name="end">
                    <div class="col">
                    </div>
                    <div class="col">
                        <label for="">Junction</label>
                        <select class="form-select" required aria-label="Please Select Junction" name="junc">
                            <option value="all">All</option>
                            <option value="na">Not applicable</option>
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
                            <option selected>Please Select Calculation Method</option>
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
    </div>
@endsection
