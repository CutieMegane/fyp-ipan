@extends('layouts.template')

@section('content')
    @if ($message = Session::get('message'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-outline-info" href="{{ route('table.create') }}"> Create Table </a>
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
                    <td>{{ $t->id }} </td>
                    <td><a href="{{ route('table.show', $t->id) }}">{{ $t->tableName }} </a></td>
                    <td>{{ $t->tableDesc }}</td>
                    <td>{{ $t->colCount }}</td>
                    <td>
                        <form action="{{ route('table.destroy', $t->id) }}" method="POST">

                            

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
