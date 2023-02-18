@extends('layouts.template')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
            <a class="btn btn-outline-info" href="{{ route('table.create') }}"> +Tb</a>
        </div><br>
    </div>
</div>
    <div class="card">
        <table class="table table-striped" style="width:100%">
    <tr>
        <th>ID</th>
        <th>Table Name</th>
        <th style="width:40% ;">Table Description</th>
        <th>Column count</th>
        <th width="150px">Action</th>
    </tr>
    @foreach ($tb as $t)
    <tr>
        <td>{{ $t -> id}} </td>
        <td>{{ $t -> tableName }}</td>
        <td>{{ $t -> tableDesc }}</td>
        <td>{{ $t -> columnCount }}</td>
        <td>
            <form action="{{ route('table.destroy',  $t->id) }}" method="POST">

                <a class="btn btn-outline-secondary" href="{{ route('table.edit', $t->id) }}">Edit</a>

                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-outline-danger">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
    
    </div>
@endsection