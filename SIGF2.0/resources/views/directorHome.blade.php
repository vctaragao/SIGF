@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in as Director! Welcome {{ $current_user->name }}
                    

                     <p>Informações: </p>

                    Nome: {{ $current_user->name }}
                    <br>
                    sexo: {{ $current_user->sex }}
                    <br>
                    CPF: {{ $current_user->cpf }}
                    <br>
                    Telefone : {{ $current_user->phone }}
                    <br>
                    Curso : {{ $current_user->course }}
                    <br>
                    email: {{ $current_user->email }}
                    
                    <br>
                    <br>

                    <p>Diretores: </p>
                    @foreach($directors as $key => $value)
                    <p>Diretor {{ $value->id }} : {{ $value->name }}</p> 
                    @endforeach

                    <a href={{ url('directorRegister') }} class="text-white btn btn-primary float-right">Adicionar Diretor</a>
                    <a href={{ url('addClass') }} class="mr-1 text-white btn btn-primary float-right">Adicionar Turma</a>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
