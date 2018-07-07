@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Dashboard
                    <a href={{ url('/studentEdit/'.$student->id) }} class="btn btn-primary float-right"> Editar <i class="fas fa-user-edit"></i></a>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-6">
                            Nome:  {{ $student->name }}
                        </div>
                        <div class="col-6">
                            <a href="" class="btn btn-primary float-right">Tornar Diretor</a>
                        </div>
                    </div>
                                       

                    <p>Informações: </p>

                    Nome: {{ $student->name }}
                    <br>
                    email: {{ $student->email }}
                    <br>
                    sexo: {{ $student->sex }}
                    <br>
                    CPF: {{ $student->cpf }}
                    <br>
                    Telefone : {{ $student->phone }}
                    <br>
                    Curso : {{ $student->course }}
                    <br>
                    Colar : {{ $student->colar }}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
