@extends('new.template')

@section('content')
    <div class="container">
        <div class="container btn-groups">
            {!! $tr->links() !!}
        </div>
        <div class="container">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Junction</th>
                        <th scope="col">Vehicle count</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tr as $t)
                        <tr>
                            <th scope="row">{{ $t->date }}</th>
                            <td>{{ $t->junc }}</td>
                            <td>{{ $t->carCount }}</td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
@endsection
