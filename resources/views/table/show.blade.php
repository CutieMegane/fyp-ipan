@extends('layouts.template')

@section('content')
<div class="card">
        {!! $db->links() !!}
        <table class="table table-striped" style="width:100%">
            <tr>
                @for ($x = 1; $x <= $colCount; $x++)
                        <th>{{$details['col'.$x.'name']}}</th>
                @endfor
                {{--<td>Action</td>  --}}  
            </tr>
            @foreach ($db as $d)
                <tr>
                    @for ($x = 1; $x <= $colCount; $x++)
                        <?php $str = 'col'.$x ?>
                        <td>{{$d->$str}}</td>
                    @endfor
                    {{--<td><a class="btn btn-outline-secondary" href="{{ route('table.edit', $d->id) }}">Edit</a></td>--}}
                        
                </tr>
            @endforeach
        </table>
    </div>
@endsection