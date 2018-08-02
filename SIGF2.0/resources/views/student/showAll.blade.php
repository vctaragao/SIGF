@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  Alunos
                </div>

                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    

                    @foreach($students as $student)

              @if(!empty($flag) && $flag == 'add')
                     <form method="POST" action={{ url('/addStudentToClassroom/'.$classroom->id)}}>
                                
                                {{ csrf_field() }}
                @endif

                   <div class="row pb-3 mb-3 border-bottom">
                     <div class="col-6 float-left">
                       @if(Auth::user()->isDirector || Auth::user()->isProfessor) <a class="" href={{ url('/student/'.$student->id) }}>{{ $student->name }}</a> @else {{ $student->name }} @endif
                     </div>

                     @if(!empty($student->profile))<div class="col-3 text-center"><a href="{{ $student->profile }}" target="_blank">Facebook</a></div>@endif

                     @if(!empty($flag) && $flag =='add' && (Auth::user()->isProfessor || Auth::User()->isDirector))

                        <div class="col-3">
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="role" id="rolecc" value="cc" >
                              <label class="form-check-label" for="rolecc">
                                Condutor
                              </label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="role" id="rolecd" value="cd">
                              <label class="form-check-label" for="rolecd">
                                Conduzido
                              </label>
                            </div>
                        </div>


                        <div class="col-3">
                            <button type="submit" name="student_id" value="{{ $student->id }}" class="float-right btn btn-primary text-white font-weight-bold">Adicionar Aluno</button>
                        </div>


                     @endif
      
                          @if(!empty($flag) && $flag == 'director')
                          <div class="col-3 float-right">
                            <a href="{{ url('/addDirector/'.$student->id) }}" class="btn btn-primary float-right">Adicionar Diretor</a>
                          </div>
                            
                          @endif

                          @if(!empty($flag) && $flag == 'professor')
                          <div class="col-3 float-right">
                            <a href="{{ url('/addProfessor/'.$student->id) }}" class="btn btn-primary float-right">Adicionar Professor</a>
                          </div>

                          @endif

                          @if(!empty($flag) && $flag == 'remove')
                          <div class="col-3 float-right">
                            <a href="{{ url('/removeStudent/'.$student->id) }}" class="btn btn-danger float-right">Remover aluno</a>
                          </div>
                            
                          @endif
                   </div>

                </form>
                    @endforeach
                
                </div>                    
                     
                </div>
            </div>
        </div>
    </div>
@endsection
