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

                    Nome: {{ $professor->name }}
                                       

                    <p>Informações: </p>

                    Nome: {{ $professor->name }}
                    <br>
                    sexo: {{ $professor->sex }}
                    <br>
                    CPF: {{ $professor->cpf }}
                    <br>
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
