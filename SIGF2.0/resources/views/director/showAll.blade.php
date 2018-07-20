@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  You are logged in as Director!
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    

                    @foreach($directors as $director)

                   <div class="row pb-2 pt-2 border-bottom">
                     <div class="col-6 float-left">
                       <a href={{ url('/director/'.$director->id) }}>{{ $director->name }}</a>
                     </div>

                     @if(!empty($flag) && $flag == 'remove')
                         <div class="col-6 float-right">
                            <a href="{{ url('/removeDirector/'.$director->id) }}" class="btn btn-danger float-right">Remover</a> 
                         </div>
                    @endif 
                   </div>

                    @endforeach
                    
                  
                     
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
