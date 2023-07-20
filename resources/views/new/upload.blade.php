@extends('new.template')

@section('content')
    <div class="container">
        @if ($message = Session::get('message'))
            <div class="alert alert-danger">
                <p>{{ $message }}</p>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <span class="text-nowrap">Please insert the data to be uploaded</span>
            </div>
            <div class="card-body">
                <form action="{{ route('new.create') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input type="file" name="file" />

                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
