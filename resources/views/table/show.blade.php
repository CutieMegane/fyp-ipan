@extends('layouts.template')

@section('content')
<div class="card">
        <table class="table table-striped" style="width:100%">
            <tr>
                @for ($x = 1; $x <= $colCount; $x++)
                        <th>{{$details['col'.$x.'name']}}</th>
                @endfor    
            </tr>
            @foreach ($db as $d)
                <tr>
                    @for ($x = 1; $x <= $colCount; $x++)
                        <?php $str = 'col'.$x ?>
                        <td>{{$d->$str}}</td>
                    @endfor
                </tr>
            @endforeach
        </table>
    </div>
@endsection