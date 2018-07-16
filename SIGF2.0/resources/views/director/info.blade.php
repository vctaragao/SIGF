@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Dashboard
                    @if(Auth::user()->isDirector == 1)
                        <a href={{ url('/studentEdit/'.$director->id) }} class="btn btn-primary float-right"> Editar <i class="fas fa-user-edit"></i></a>
                    @endif
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    Nome:  {{ $director->name }}
                                       

                    <p>Informações: </p>

                    Nome: {{ $director->name }}
                    <br>
                    email: {{ $director->email }}
                    <br>
                    sexo: {{ $director->sex }}
                    <br>
                    CPF: {{ $director->cpf }}
                    <br>
                    Telefone : {{ $director->phone }}
                    <br>
                    Curso : {{ $director->course }}
                    <br>
                    Colar : {{ $director->colar }}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
