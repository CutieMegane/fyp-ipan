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
                        <input type="date" class="form-control" id="start" name="start">
                    </div>
                    <div class="col">
                        <label for="end">End Date</label>
                        <input type="date" class="form-control" id="end" name="end">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label for="junc">Junction</label>
                        <select class="form-select" required aria-label="Please Select Junction" name="junc">
                            <option value="">Select</option>
                            <option value="all">All</option>
                            <option value="">Not applicable</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                            <option value="4">Four</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label for="opr">Calculation</label>
                        <select class="form-select" aria-label="Please Select Operation" id="opr" name="opr">
                            <option value="">Select</option>
                            <option value="sum">Sum</option>
                            <option value="avg">Average</option>
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
