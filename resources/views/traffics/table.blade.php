@section('content')

<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>List of Routes</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('traffics.create') }}"> Add New Route</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>DateTime</th>
            <th>Junction</th>
            <th>Vehicles</th>
            <th>ID</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($traffic as $t)
        <tr>
            <td>{{ $t->DateAndTime }}</td>
            <td>{{ $t->Junction }}</td>
            <td>{{ $t->Vehicles }}</td>
            <td>{{ $t->number }}</td>
            <td>
                <form action="{{ route('traffics.destroy',$t->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('traffics.show',$t->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('traffics.edit',$t->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {!! $traffic->links() !!}
@endsection