@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Perfil    

                    @if(!empty($flag) && $flag == 'open')
                     <button type="button" class="btn btn-success float-right mr-3" data-toggle="modal" data-target="#exampleModal">
                     Realizar inscricão nas turmas
                    </button>
                    @endif
                </div>

                <div class="card-body">
                    @if (session('subscription-error'))
                        <div class="alert alert-warning">
                            {{ session('subscription-error') }}
                        </div>
                    @endif

                    @if (session('subscription-success'))
                        <div class="alert alert-success">
                            {{ session('subscription-success') }}
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
            
                    <div class="row p-2">
                      Bem vindo! {{ $current_student->name }}
                    </div>       
                    <div class="row p-2">
                    <p>Informações: </p>
                    </div>
                    <br>
                    
                    <div class="row p-2">
                       sexo: {{ $current_student->sex }}
                    </div>
                   
                    <div class="row p-2">
                      CPF:  {{$current_student->cpf }}
                    </div>
                    
                    <div class="row p-2">
                       Telefone : {{ $current_student->phone }}
                    </div>
                   
                    <div class="row p-2">
                      Curso : {{ $current_student->course }}
                    </div>
                    
                    <div class="row p-2">
                      email: {{ $current_student->email }}
                    </div>
                    
                   
                    {{-- Professor: @if($current_student->isProfessor){{{ "Sim" }}}@else{{{ "Não" }}} @endif
                    <br>
                    Diretor: @if($current_student->isDirector){{{ "Sim" }}}@else{{{ "Não" }}} @endif --}}

                </div>


                @if(!empty($flag) && $flag == 'open')
                 <!-- Modal -->
                  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Realizar inscrição</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form method="POST" action="{{ url('/subscription') }}">
                              @csrf

                                <table class="table">
                                      <thead>
                                        <tr>
                                          <th scope="col">Selecionar turma</th>
                                          <th scope="col">Nome</th>
                                          <th scope="col">Horário</th>
                                          <th scope="col">Dia</th>
                                          <th scope="col">Papel</th>
                                        </tr>
                                      </thead>
                                     <tbody>
                                        @foreach($classrooms as $classroom)
                                            <tr>
                                              <th scope="row" style="text-align:center;">
                                                     <input id="{{ $classroom->id }}" name="classrooms[{{ $classroom->id }}]" type="checkbox">
                                              </th>
                                              <td ><a href={{ url('/classroom/'.$classroom->id) }}>{{ $classroom->name }}</a></td>
                                              <td>{{ $classroom->schedule }}</td>
                                              <td>{{ $classroom->day }}</td>
                                              <td>
                                                <div class="col-3 ">
                                                   <div class="form-check">
                                                     <input class="form-check-input" type="radio" name="role[{{ $classroom->id }}]" id="exampleRadios{{ $classroom->id }}" value="cc" >
                                                     <label class="form-check-label" for="exampleRadios{{ $classroom->id }}">
                                                       Condutor
                                                     </label>

                                                   </div>
                                                   <div class="form-check">
                                                     <input class="form-check-input" type="radio" name="role[{{ $classroom->id }}]" id="exampleRadios{{ $classroom->id }}b" value="cd">
                                                     <label class="form-check-label" for="exampleRadios{{ $classroom->id }}b">
                                                       Conduzido
                                                     </label>

                                                  </div>

                                                   @if ($errors->has('role[{{ $classroom->id }}]'))
                                                         <span class="invalid-feedback">
                                                             <strong>{{ $errors->first('role['. $classroom->id .']') }}</strong>
                                                         </span>
                                                     @endif

                                                </div>
                                              </td>
                                              
                                            </tr>
                                        @endforeach
                                     </tbody>
                                 </table>

                                     <div class="form-group row mt-5">
                                         <label for="password-confirm" class="col-md-3 col-form-label text-right">{{ __('Confirmar senha') }}</label>

                                         <div class="col-md-5">
                                             <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                         </div>
                                        <div class="col-2">
                                            <button type="submit" name="student_id" value="{{ $current_student->id }}" class="btn btn-success">
                                                Finalizar inscrição
                                            </button>
                                        </div>
                                         
                                     </div>                             
                              
                                  </form> 

                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
