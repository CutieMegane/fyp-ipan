@extends('new.template')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Edit user {{$user->name}}</h2>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <input type="hidden" name="id" value="{{ $user->id }}"> <br />

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Name:</strong>
                        <input type="text" name="name" value="{{ $user->name }}" class="form-control"
                            placeholder="Name">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Email:</strong>
                        <input type="type" class="form-control" name="email" value="{{ $user->email }}"
                            placeholder="Email"></input>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>User Level:</strong>
                        <br>
                        <div class="container btn-group" role="group" aria-label="Admin level">
                            <input type="radio" class="btn-check" name="level" id="level1" value="1"
                                autocomplete="off">
                            <label class="btn btn-outline-warning" for="level1">Admin</label>

                            <input type="radio" class="btn-check" name="level" id="level0" value="0"
                                autocomplete="off" checked>
                            <label class="btn btn-outline-secondary" for="level0">User</label>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Password:</strong>
                        <input type="password" class="form-control" name="password" placeholder="Password"></input>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-outline-secondary">Submit</button>
                    <a class="btn btn-outline-secondary" href="{{ route('users.index') }}"> Back</a>
                </div>
            </div>
        </form>
    </div>
@endsection
