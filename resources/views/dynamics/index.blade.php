@extends('layouts.template')

@section('content')

    <div class="card">
        <div class="card-body row row-cols-lg-auto g-3">
            
            <form action="{{ route('dynamic.create') }}" method="POST">
                @csrf
                <div class="card-header">
                    <span class="text-nowrap">Create New Table</span>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-12">
                        <div class="form-group">
                            <strong>Table Name:</strong>
                            <input type="text" name="tableName" class="form-control" placeholder="TableName">
                        </div>
                    </div>
                    {{--  <div class="col-xs-6 col-sm-6 col-md-12">
                        <div class="form-group">
                            <strong>Column Name:</strong>
                            <input type="text" class="col1" name="col1" placeholder="Column Name">
                        </div>
                    </div> --}}
                   
                    <div class="col-xs-6 col-sm-6 col-md-12">
                        <label for="col1" class="form-label">Number of Columns</label>
                        <input type="number" class="form-control" name="col1" id="col1" min="1" value="4">
                    </div>
                    <div class="field_wrapper">
                        <div>
                            <input type="text" name="field_name[]" value=""/>
                            <a href="javascript:void(0);" class="add_button" title="Add field"><img src="{{ asset('img/add-icon.png') }}" width="50" height="50"/></a>
                        </div>
                        <button type="submit">submit</button>
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </div>                
            </form>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            var maxField = 10; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.field_wrapper'); //Input field wrapper
            var fieldHTML = '<div><input type="text" name="field_name[]" value=""/><a href="javascript:void(0);" class="remove_button"><img src="{{ asset('img/remove-icon.png') }}" width="50" height="50"/></a></div>'; //New input field html 
            var x = 1; //Initial field counter is 1
            
            //Once add button is clicked
            $(addButton).click(function(){
                //Check maximum number of input fields
                if(x < maxField){ 
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); //Add field html
                }
            });
            
            //Once remove button is clicked
            $(wrapper).on('click', '.remove_button', function(e){
                e.preventDefault();
                $(this).parent('div').remove(); //Remove field html
                x--; //Decrement field counter
            });
        });
        </script>
@endsection