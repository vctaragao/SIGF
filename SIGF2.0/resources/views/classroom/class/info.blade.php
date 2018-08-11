@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">

                    <strong>Turma   {{ $classroom->name }}</strong>
                    
                    @if(Auth::user()->isProfessor)
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ url('/classEdit/'.$class->id) }}">Editar Aula</a>
                        </div>

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger float-right mr-3" data-toggle="modal" data-target="#exampleModal">
                         Remover Aula
                        </button>

                    @endif
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @elseif(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                                       
                    <br>
                    <strong>Data:</strong> {{ $class->date }}
                    <br>
                    <strong>Conteudo:</strong> {{ $class->content }}
                    <br>
                    @if(isset($presence)) Presença na aula: @if($presence[0]->presence) {{ "Sim" }} @else {{ "Não" }} @endif @endif

                </div>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Remover aula</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form method="POST" action="{{ url('/removeClass') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="confirm_password" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar senha: ') }}</label>

                                <div class="col-md-6">
                                    <input id="confirm_password" type="password" class="form-control{{ $errors->has('confirm_password') ? ' is-invalid' : '' }}" name="confirm_password" autofocus required>

                                    <input name="user_id" value="{{ Auth::user()->id }}" type="hidden">

                                    @if ($errors->has('confirm_password'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('confirm_password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <button name="class_id" value="{{ $class->id }}" type="submit" class="btn btn-danger">Remover Aula</button>
                            </div>

                        </form>
                      </div>
                    </div>
                  </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
