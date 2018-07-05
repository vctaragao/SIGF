@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Turmas</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in as Director! Welcome

                    <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">ID</th>
                              <th scope="col">Nome</th>
                              <th scope="col">Horário</th>
                              <th scope="col">Dia</th>
                              <th scope="col">Tamanho</th>
                            </tr>
                          </thead>
                         <tbody>
                            @foreach($classrooms as $classroom)
                                <tr>
                                  <th scope="row">{{ $classroom->id }}</th>
                                  <td><a href={{ url('/showClassroom/'.$classroom->id) }}>{{ $classroom->name }}</a></td>
                                  <td>{{ $classroom->schedule }}</td>
                                  <td>{{ $classroom->day }}</td>
                                  <td>{{ $classroom->size }}</td>
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
