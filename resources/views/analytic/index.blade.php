@extends('layouts.template')

@section('content')
    @if ($message = Session::get('message'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Charts') }}</div>
    
                    <div class="container px-4 mx-auto">
    
                        <div class="p-6 m-20 bg-white rounded shadow">
                            {!! $trafficChart->container() !!}
                        </div>
                    
                    </div>
                    
                    <script src="{{ $trafficChart->cdn() }}"></script>
                    
                    {{ $trafficChart->script() }}
                </div>
            </div>
        </div>
    </div>
    
@endsection
