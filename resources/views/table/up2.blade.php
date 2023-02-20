@extends('layouts.template')

@section('content')
    <div class="card">
        <form action="{{ route('table.store') }}" method="POST">
            @csrf
            <div class="card-header">
                <span class="text-nowrap">Create New Table</span>
            </div>

            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-12">
                    <div class="form-group">
                        <strong>Table Name:</strong>
                        <input type="text" name="tableName" class="form-control" placeholder="TableName" required>
                        <strong>Table Description:</strong>
                        <textarea name="tableDesc" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        
                    </div>
                </div>

                <div class="col-xs-6 col-sm-6 col-md-12">
                    <div class="form-group">
                        @for ($i = 1; $i <= $output['colCount']; $i++)
                            <div>
                                <input type="text" name="col{{$i}}name" value="{{ $output['col' . $i] }}" />
                                <select name="col{{$i}}type" class="form-select" aria-label="Choose data type">
                                    <option value="string">String</option>
                                    <option value="integer">Integer</option>
                                    <option value="float">Float</option>
                                    <option value="boolean">Boolean</option>
                                    <option value="date">Date (YYYY-MM-DD)</option>
                                    <option value="dateTime">Date and Time (YYYY-MM-DD HH:MM:SS.MSMS)</option>
                                </select>

                            </div>
                        @endfor
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <input type="hidden" name="colCount" value="{{$output['colCount']}}">
                    <input type="hidden" name="upld" value="{{$output['file']}}">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </div>
        </form>
    </div>
@endsection
