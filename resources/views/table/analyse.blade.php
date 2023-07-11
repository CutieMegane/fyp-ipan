@extends('layouts.template')

@section('content')
    @if ($message = Session::get('message'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
    @endif

   <h1>adasdqwrad</h1>
@endsection
