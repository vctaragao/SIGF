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

                    You are logged in as a Student! Welcome {{ $current_student->name }}
                                       

                    <p>Informações: </p>

                    Nome: {{ $current_student->name }}
                    <br>
                    sexo: {{ $current_student->sex }}
                    <br>
                    CPF: {{ $current_student->cpf }}
                    <br>
                    Telefone : {{ $current_student->phone }}
                    <br>
                    Curso : {{ $current_student->course }}
                    <br>
                    email: {{ $current_student->email }}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
