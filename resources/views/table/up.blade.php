@extends('layouts.template')

@section('content')

@if ($message = Session::get('message'))
<div class="alert alert-danger">
    <p>{{ $message }}</p>
</div>
@endif

    <div class="card">
        <div class="card-body row row-cols-lg-auto g-3">
        
                <div class="card-header">
                    <span class="text-nowrap">Structure</span>
                </div>
                <div class="card-body">
                    <form action="{{route('table.create')}}" method="post" enctype="multipart/form-data">
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