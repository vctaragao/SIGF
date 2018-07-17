@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Registrar Aula') }}</div>

                <div class="card-body">
                    <form method="POST" action={{ url('/addClassToClassroom/'. $classroom->id) }}>
                        @csrf
                        <div class="d-flex justify-content-around">
                            <div class="d-flex flex-column">
                                    <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Data: ') }}</label>

                                    <div class="col-md-6">
                                        <input id="date" type="text" class="form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" name="date" value="{{ old('date') }}"  autofocus>

                                        @if ($errors->has('date'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('date') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="content" class="col-md-4 col-form-label text-md-right">{{ __('Conteudo') }}</label>

                                    <div class="col-md-6">
                                        <textarea id="content" type="text" class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" name="content" value="{{ old('content') }}" ></textarea>

                                        @if ($errors->has('content'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('content') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                    </div>
                                </div>



                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button name="isDirector" value="1" type="submit" class="btn btn-primary">
                                            {{ __('Registrar') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-column">
                                <h3>Faltas</h3>

                                @if (session('error'))
                                            <span class="alert alert-danger">
                                                <strong>{{ session('error') }}</strong>
                                            </span>
                                @else
                                
                                    @foreach($students as $student)
                                        <div class="row">
                                            <div class="col-6 float-left">{{ $student->name }}</div>
                                            <div class="col-6 float-right">
                                                <input name="presence" value="{{ $student->id }}" type="checkbox">
                                            </div>
                                        </div>
                                    @endforeach

                                @endif
                            </div>
                            
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
