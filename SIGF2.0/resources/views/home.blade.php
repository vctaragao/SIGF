@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Perfil</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    Bem vindo! {{ $current_student->name }}
                                       

                    <p>Informações: </p>

                    ID: {{ $current_student->id }}
                    <br>
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
                    <br>
                    Professor: @if($current_student->isProfessor){{{ "Sim" }}}@else{{{ "Não" }}} @endif
                    <br>
                    Diretor: @if($current_student->isDirector){{{ "Sim" }}}@else{{{ "Não" }}} @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
