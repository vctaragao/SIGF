@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row pl-0 pr-0 justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Turma {{ $classroom->name }} Horario: {{ $classroom->schedule }}  
                  @if(Auth::user()->isDirector || Auth::user()->isProfessor)
                  <a class="btn btn-primary float-right ml-2" href={{ url('/showClasses/'.$classroom->id) }}>Ver Aulas</a>
                  <a class="btn btn-primary float-right ml-2" href={{ url('/addClassToClassroom/'.$classroom->id) }}>Adicionar Aula</a>
                    <a class="btn btn-primary float-right" href={{ url('/addStudentToClassroom/'.$classroom->id) }}>Adicionar aluno</a>
                    <a class="btn btn-primary float-right mr-2" href={{ url('/editClassroom/'.$classroom->id) }}>Editar turma</a>

                    <button type="button" class="btn btn-danger float-right mr-3" data-toggle="modal" data-target="#exampleModal">
                     Remover turma
                    </button>
                  @endif
                </div>

                <div class="card-body pb-2">
                    @if (session('error'))
                        <div class="alert alert-success">
                            {{ session('error') }}
                        </div>
                    @endif
                    
                  <div class="mt-2 row justify-content-around">
                    <div class="col-6 flex flex-column bold-text">
                        <h6 class="font-weight-bold border-bottom text-center">Condutor</h6>
                      @foreach($leaders as $leader)
                        <div class="row mr-2 @if($leader->wait) text-white bg-secondary @endif">
                            <div class="col-4 pt-2 pb-2">{{ $leader->name }}</div>
                            <div class="col-4 pt-2 pb-2 text-center">{{ $leader->phone }}</div>

                            @if(Auth::user()->isDirector || Auth::user()->isProfessor)
                              <div class="col-4 pt-2 pb-2 ">

                                <a href="{{ url('/removeStudentFromClassroom/' . $classroom->id . '/' . $leader->id) }}" class="text-danger font-weight-bold float-right"><i class="material-icons">close</i></a>


                                @if($leader->wait)
                                  <a href="{{ url('/putOffWait/'.$classroom->id.'/'.$leader->id) }}" class=" text-warning float-right"><i class="material-icons">arrow_upward</i></a>
                                @else
                                  <a href="{{ url('/putOnWait/'.$classroom->id.'/'.$leader->id) }}" class="text-warning float-right"><i class="material-icons">arrow_downward</i></a>
                                @endif

                                
                              </div>


                            @endif
                        </div>
                      @endforeach
                    </div>
                          
                      <div class="col-6 flex flex-colunm bold-text ">
                        <div class="border-bottom font-weight-bold text-center">Conduzido</div>
                        @foreach($leds as $led)
                          <div class="row mr-2 @if($led->wait) text-white bg-secondary @endif">
                            <div class="col-4 pt-2 pb-2">{{ $led->name }}</div>
                            <div class="col-4  pt-2 pb-2 text-center">{{ $led->phone }}</div>

                            @if(Auth::user()->isDirector || Auth::user()->isProfessor)
                              <div class="col-4 pt-2 pb-2">

                                <a href="{{ url('/removeStudentFromClassroom/' . $classroom->id . '/' . $led->id) }}" class="text-danger font-weight-bold float-right"><i class="material-icons">close</i></a>

                                @if($led->wait)
                                   <a href="{{ url('/putOffWait/'.$classroom->id.'/'.$led->id) }}" class=" text-warning float-right"><i class="material-icons">arrow_upward</i></a>
                                 @else
                                   <a href="{{ url('/putOnWait/'.$classroom->id.'/'.$led->id) }}" class="text-warning float-right"><i class="material-icons">arrow_downward</i></a>
                                 @endif 
                              </div>   
                            @endif    
                        </div>
                        @endforeach
                      </div>
                        
                    </div>

                  </div>

                  <!-- Modal -->
                  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Remover Turma</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form method="POST" action="{{ url('/removeClassroom') }}">
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
                                  <button name="classroom_id" value="{{ $classroom->id }}" type="submit" class="btn btn-danger">Remover Turma</button>
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
</div>
@endsection
