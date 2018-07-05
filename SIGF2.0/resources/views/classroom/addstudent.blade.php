@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Turma {{ $classroom->name }} </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                         <div class="row">
                           <div class="col-6">Alunos</div>
                           <div class="col-6">Papel</div>
                         </div>

                         @foreach($students as $student)
                             <form method="POST" action={{ url('/addStudentToClassroom') }}>
                                 {{ csrf_field() }}
                                 <div class="row border-bottom">
                                    
                                    <div class="col-4 ">
                                      <input name="user_id" value="{{ $student->id }}" hidden>
                                      {{ $student->name}}
                                    </div>

                                    <div class="col-3 ">
                                       <div class="form-check">
                                         <input class="form-check-input" type="radio" name="role" id="exampleRadios1" value="cc" >
                                         <label class="form-check-label" for="exampleRadios1">
                                           Condutor
                                         </label>
                                       </div>
                                       <div class="form-check">
                                         <input class="form-check-input" type="radio" name="role" id="exampleRadios2" value="cd">
                                         <label class="form-check-label" for="exampleRadios2">
                                           Conduzido
                                         </label>
                                      </div>
                                    </div>
                                       
                                    <div class="row col-5 float-right">
                                      <button type="submit" name="classroom_id" value={{ $classroom->id }} class="btn btn-primary float-right">Adicionar a turma</button>
                                    </div>
                                     
                                 </div>
                          </form>
                         @endforeach   
                    </div>                 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
