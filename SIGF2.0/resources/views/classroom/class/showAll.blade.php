@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Turma {{ $classroom->name }}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif             

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif             

                    <p>Aulas: </p>

                    
                    @foreach($classes as $class)
                        <div class="row">
                            <a href={{ url('/showClassInfo/'.$classroom->id.'/'.$class->id) }}>{{ $class->date }}</a>                            
                        </div>

                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
