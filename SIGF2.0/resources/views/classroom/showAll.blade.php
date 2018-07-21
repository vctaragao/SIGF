@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
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
                              <th scope="col">Tamanho</th>
                            </tr>
                          </thead>
                         <tbody>
                            @foreach($classrooms as $classroom)
                                <tr>
                                  <th scope="row">{{ $classroom->id }}</th>
                                  <td><a href={{ url('/classroom/'.$classroom->id) }}>{{ $classroom->name }}</a></td>
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