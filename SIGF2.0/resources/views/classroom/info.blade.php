@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Turma {{ $classroom->name }} Horario: {{ $classroom->schedule }}  
                  @if(Auth::user()->isDirector || Auth::user()->isProfessor)
                  <a class="btn btn-primary float-right ml-2" href={{ url('/showClasses/'.$classroom->id) }}>Ver Aulas</a>
                  <a class="btn btn-primary float-right ml-2" href={{ url('/addClassToClassroom/'.$classroom->id) }}>Adicionar Aula</a>
                    <a class="btn btn-primary float-right" href={{ url('/addStudentToClassroom/'.$classroom->id) }}>Adicionar aluno</a>
                  @endif
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                  <div class="mt-2 row justify-content-around">
                    <div class="col-6 flex flex-column bold-text">
                        <h6 class="font-weight-bold border-bottom text-center">Condutor</h6>
                      @foreach($leaders as $leader)
                        <div class="row">
                            <div class="col-4 pt-2 pb-2">{{ $leader->name }}</div>
                            <div class="col-4 pt-2 pb-2">{{ $leader->phone }}</div>
                            @if(Auth::user()->isDirector || Auth::user()->isProfessor)
                              <div class="col-4 pt-2 pb-2">
                                <a href="{{ url('/removeStudentFromClassroom/' . $classroom->id . '/' . $leader->id) }}" class="btn btn-danger text-white">Remover Aluno</a>
                              </div>    
                            @endif
                        </div>
                      @endforeach
                    </div>
                          
                      <div class="col-6 flex flex-colunm bold-text ">
                        <div class="border-bottom font-weight-bold text-center">Conduzido</div>
                        @foreach($leds as $led)
                          <div class="row">
                            <div class="col-4 pt-2 pb-2">{{ $led->name }}</div>
                            <div class="col-4 pt-2 pb-2">{{ $led->phone }}</div>
                            @if(Auth::user()->isDirector || Auth::user()->isProfessor)
                              <div class="col-4 pt-2 pb-2">
                                <a href="{{ url('/removeStudentFromClassroom/' . $classroom->id . '/' . $led->id) }}" class="btn btn-danger text-white">Remover Aluno</a>
                              </div>    
                            @endif    
                        </div>
                        @endforeach
                      </div>
                        
                    </div>

                  </div>
                     
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
