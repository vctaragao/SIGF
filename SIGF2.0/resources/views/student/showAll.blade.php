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

                    

                    @foreach($students as $student)

                   <div class="row pb-3 mb-3 border-bottom">
                     <div class="col-6 float-left">
                       <a class="" href={{ url('/studentShow/'.$student->id) }}>{{ $student->name }}</a>
                     </div>

                     @if($flag = 'add')
                        <div class="col-6">
                            <a href={{ url('directorAdd/'.$student->id) }} class="float-right btn btn-primary">Tornar Diretor</a>
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