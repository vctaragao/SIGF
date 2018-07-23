@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><strong>Nome: </strong>{{ $current_student->name }}
                    @if(Auth::user()->isDirector) 
                        <a href="{{ url('/studentEdit/'.$current_student->id) }}" class="btn btn-primary float-right">Editar <i class="fas fa-user-edit"></i></a>
                    @endif</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                                       

                    <p>Informações: </p>
                    
                    <br>
                    sexo: {{ $current_student->sex }}
                    <br>
                    @if(Auth::user()->isDirector) {{ "CPF: " .$current_student->cpf }}  <br> @endif
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
