@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <strong>Nome:</strong> {{ $professor->name }}
                    @if(Auth::user()->isDirector)
                        <a href={{ url('/studentEdit/'.$professor->id) }} class="btn btn-primary float-right"> Editar <i class="fas fa-user-edit"></i></a>
                    @endif
                </div>



                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                  

                    <p>Informações: </p>

                    sexo: {{ $professor->sex }}
                    <br>
                    @if(Auth::user()->isDirector) 
                    CPF: {{ $professor->cpf }}
                     <br>
                    @endif
                    Telefone : {{ $professor->phone }}
                    <br>
                    Curso : {{ $professor->course }}
                    <br>
                    email: {{ $professor->email }}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
