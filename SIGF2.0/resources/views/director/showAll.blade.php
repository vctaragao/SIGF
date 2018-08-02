@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  Diretores
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
                       @if(Auth::user()->isDirector || Auth::user()->isProfessor) <a class="" href={{ url('/director/'.$director->id) }}>{{ $director->name }}</a> @else {{ $director->name }} @endif
                     </div>

                     <div class="col-3 text-center"><a href="{{ $director->profile }}" target="_blank">Facebook</a></div>


                     @if(!empty($flag) && $flag == 'remove')
                         <div class="col-3 float-right">
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
