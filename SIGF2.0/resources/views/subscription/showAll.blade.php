@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">

                    @if(!empty($flag) && $flag == 'open')

                    Turmas fechadas para inscrições

                    @else

                    Turmas abertas para inscrições

                    @endif

                  
                </div>

                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if(!empty($flag) && $flag == 'open')

                    <form method="POST" action="{{ url('/openSubscription') }}">  
                        @csrf

                    @endif

                    @if(!empty($flag) && $flag == 'close')

                    <form method="POST" action="{{ url('/closeSubscription') }}">  
                        @csrf

                    @endif

                    <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">ID</th>
                              <th scope="col">Nome</th>
                              <th scope="col">Horário</th>
                              <th scope="col">Dia</th>
                              @if(!empty($flag) && $flag == 'open') <th scope="col">Abrir Turma</th> @endif
                              @if(!empty($flag) && $flag == 'close') <th scope="col">Fechar Turma</th> @endif
                            </tr>
                          </thead>
                         <tbody>
                            @foreach($classrooms as $classroom)
                                <tr>
                                  <th scope="row">{{ $classroom->id }}</th>
                                  <td><a href={{ url('/classroom/'.$classroom->id) }}>{{ $classroom->name }}</a></td>
                                  <td>{{ $classroom->schedule }}</td>
                                  <td>{{ $classroom->day }}</td>
                                  <td>
                                       @if(!empty($flag) && ($flag == 'open' || $flag == 'close'))
                                         <input id="{{ $classroom->id }}" name="classrooms[{{ $classroom->id }}]" type="checkbox">
                                      @endif
                                  </td>
                                </tr>
                            @endforeach
                         </tbody>
                     </table>

                    @if(!empty($flag) && ($flag == 'open' || $flag == 'close'))
                         <div class="form-group row mt-5">
                             <label for="password-confirm" class="col-md-3 col-form-label text-right">{{ __('Confirmar senha') }}</label>

                             <div class="col-md-5">
                                 <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                             </div>
                            <div class="col-2">
                                <button type="submit" class="btn btn-success">
                                    @if($flag == 'open')Abrir Turmas @endif
                                    @if($flag == 'close')Fechar Turmas @endif
                                </button>
                            </div>
                             
                         </div>                             
            
                      </form>
                  @endif   
                     
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
