@extends('layouts.app')

@push('head')
<style>
    .card-new-task {
        margin-bottom: 20px;
    }
    .card-new-link {
        margin-bottom: 20px;
    }        
</style>    

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $("#url_valid").hide();
    $("#url_invalid").hide();

    // $('#label').on('keydown', function(){
    //     var value = $(this).val();
    //     console.log(value);
    // });

    $('#url').on('keyup', function(){
        var value = $(this).val();
        if (value == null || value == ''){
            $("#url_valid").hide();
            $("#url_invalid").hide();
        }else if(/^(http|https|ftp):\/\/[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/i.test(value)){
            console.log("value: "+value+" (Valid URL)");
            $("#url_invalid").hide();
            $("#url_valid").show();
        }else{
            console.log("value: "+value+" (Invalid URL)");
            $("#url_valid").hide();
            $("#url_invalid").show();            
        }
    });    
});
</script>
@endpush


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <div class="card card-new-link">
                <div class="card-header">New Link</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('links.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="label">Label</label>
                            <input id="label" name="label" type="text" maxlength="255" class="form-control{{ $errors->has('label') ? ' is-invalid' : '' }}" autocomplete="off" />
                            @if ($errors->has('label'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('label') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="url">URL</label>
                            <input id="url" name="url" type="text" maxlength="255" class="form-control{{ $errors->has('url') ? ' is-invalid' : '' }}" autocomplete="off" />
                            <br>
                            <div id="url_valid" class="alert alert-success" role="alert">
                                URL is Valid
                            </div>

                            <div id="url_invalid" class="alert alert-danger" role="alert">
                                URL is Invalid. (Example: https://google.com)
                            </div>                                                 
                                                                            
                            @if ($errors->has('url'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('url') }}</strong>
                                </span>
                            @endif                                                                           
                        </div>                        

                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>

            <br>
            <div class="card">
                <div class="card-header">Links</div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col" style="min-width: 75%;">Link</th>
                                <th scope="col">Action</th>
         
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($links as $link)
                            <tr>
                                <th scope="row">{{ $link->id }}</th>

                                <td>
                                    <a href="{{ $link->url }}">{{ $link->label }}</a>
                                </td>

                                <td class="text-right">
                                    <!-- TODO: Delete Button -->
                                    <form action="{{ route('links.destroy', $link->id) }}" method="POST">
                                        <!-- {{ csrf_field() }} -->
                                        @csrf
                                        {{ method_field('DELETE') }}

                                        <button type="submit" id="delete-link-{{ $link->id }}" class="btn btn-danger">
                                            <i class="fa fa-btn fa-trash"></i>Delete
                                        </button>
                                    </form>                                
                                
                                </td>                
                            </tr>
                            @endforeach


                        </tbody>
                    </table>

                    {{ $links->links() }}

                </div>                
            </div>
            <br>

        </div>
    </div>
</div>
@endsection