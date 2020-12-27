@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    <div>
                        <h3>User</h3>
                        <hr>
                        <table style="width:100%">
                            <tr>
                                <th>id:</th>
                                <td>{{ Auth::user()->id }}</td>
                            </tr>
                            <tr>
                                <th>name:</th>
                                <td>{{ Auth::user()->name }}</td>
                            </tr>                        
                            <tr>
                                <th>email:</th>
                                <td>{{ Auth::user()->email }}</td>
                            </tr>
                        </table>   
                        <hr>   
                        <!-- <h3>Contacts</h3> -->
          
                        <hr>                  
                    </div>

                    <div>{{ __('You are logged in!') }}</div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
