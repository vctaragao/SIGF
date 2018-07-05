@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Turma {{ $classroom->name }} Horario: {{ $classroom->schedule }}  
                  @if(Auth::user()->isDirector || Auth::user()->isProfessor)
                    <a class="btn btn-primary float-right" href={{ url('/addStudentToClassroom/'.$classroom->id) }}>Adicionar aluno</a>
                  @endif
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in as Director!
                    
                  <div class="mt-2 row justify-content-between">
                    <div class="ml-5 flex flex-column bold-text">
                        <h6 class="font-weight-bold border-bottom">Condutor</h6>
                      @foreach($condutores as $condutor)
                          <div class="pt-2 pb-2">{{ $condutor->name }}</div>
                      @endforeach
                    </div>
                          
                      <div class="mr-5 flex flex-colunm bold-text ">
                        <div class="border-bottom font-weight-bold">Conduzido</div>
                        @foreach($conduzidos as $conduzido)
                          <div class="pt-2 pb-2">{{ $conduzido->name }}</div>
                        @endforeach
                      </div>
                        
                     </table>

                  </div>
                     
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
