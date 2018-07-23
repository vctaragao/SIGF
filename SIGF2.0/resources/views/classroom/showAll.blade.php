@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Turmas</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">ID</th>
                              <th scope="col">Nome</th>
                              <th scope="col">Horário</th>
                              <th scope="col">Dia</th>
                              <th scope="col">Papel</th> 

                              @if(Auth::user()->isDirector || Auth::user()->isProfessor) <th scope="col">Tamanho</th> @endif

                              <th scope="col">Faltas</th>
                              <th>Aulas</th>

                            </tr>
                          </thead>
                         <tbody>
                            @foreach($classrooms as $classroom)
                                <tr>
                                  <th scope="row">{{ $classroom->id }}</th>
                                  <td>@if(Auth::user()->isDirector || Auth::user()->isProfessor)
                                    <a href={{ url('/classroom/'.$classroom->id) }}>
                                      @endif
                                      {{ $classroom->name }}
                                    @if(Auth::user()->isDirector || Auth::user()->isProfessor)
                                      </a>
                                    @endif
                                  </td>
                                  <td>{{ $classroom->schedule }}</td>
                                  <td>{{ $classroom->day }}</td>
                                  <td>@if($classroom->role == 'cc') {{ "Condutor" }} @else {{ "Conduzido" }} @endif</td>
                                  @if(Auth::user()->isDirector || Auth::user()->isProfessor)<td>{{ $classroom->size }}</td>@endif
                                  <td> {{ count((Auth::user()->classes()->where('classes.classroom_id', '=', $classroom->id)->where('attendences.presence', '=', 0)->get())) }}
                                  </td>
                                  <td>
                                    @if(!$classroom->wait)
                                      <a class="btn btn-primary  mr-2" href={{ url('/showClasses/'.$classroom->id) }}>Ver Aulas</a></td>
                                    @else
                                      {{ "Fila de espera." }}
                                    @endif
                                </tr>
                            @endforeach
                         </tbody>
                     </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
