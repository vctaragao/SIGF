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

                    

                    @foreach($students as $student)

              @if(!empty($flag))
                     <form method="POST" action={{ url('/addStudentToClassroom/'.$classroom->id)}}>
                                
                                {{ csrf_field() }}
                @endif

                   <div class="row pb-3 mb-3 border-bottom">
                     <div class="col-6 float-left">
                       <a class="" href={{ url('/student/'.$student->id) }}>{{ $student->name }}</a>
                     </div>

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


                   </div>

                </form>
                    @endforeach
                
                </div>                    
                     
                </div>
            </div>
        </div>
    </div>
@endsection
