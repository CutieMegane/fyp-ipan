@extends('layouts.template')

@section('content')

    <div class="card">
        <div class="card-body row row-cols-lg-auto g-3">
            
            <form action="{{ route('dynamic.create') }}" method="POST">
                @csrf
                <div class="card-header">
                    <span class="text-nowrap">Structure</span>
                </div>
                <div class="card-body">
                    <form action="{{route('traffic.import')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="file" name="file" />
        
                            <button type="submit" class="btn btn-primary">Import</button>
                        </div>
                   </form>
                </div>              
            </form>
        </div>
    </div>
    
@endsection