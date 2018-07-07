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

                    

                    @foreach($directors as $student)

                   <dir class="row">
                     <div class="col-6 float-left">
                       <a href={{ url('/studentShow/'.$student->id) }}>{{ $student->name }}</a>
                     </div>
                     <div class="col-6">
                        <a href="{{ url('/directorAdd/'.$director->id) }}" class="btn btn-danger">Adicionar</a> 
                     </div>
                   </dir>

                    @endforeach
                    
                  
                     
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
