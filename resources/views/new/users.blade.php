@extends('new.template')

@section('content')
<div class="container">
<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>List of Users</h2>
            </div>
            
            <div class="pull-right mb-2">
                <a class="btn btn-outline-secondary" href="{{ route('users.create') }}"> Add New User</a>
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
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
            <th>User Level</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($user as $u)
        <tr>
            <td>{{ $u->id }}</td>
            <td>{{ $u->name }}</td>
            <td>{{ $u->email }}</td>
            <td>
                @if($u->level == 1)
                    Admin                        
                @else
                    User 
                @endif
            </td>
            <td>
                <form action="{{ route('users.destroy',$u->id) }}" method="POST">
   
                    <a class="btn btn-outline-secondary" href="{{ route('users.show',$u->id) }}">Show</a>
    
                    <a class="btn btn-outline-secondary" href="{{ route('users.edit',$u->id) }}">Edit</a>
   
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