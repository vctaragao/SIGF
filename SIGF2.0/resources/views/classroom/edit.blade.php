@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Editar Turma') }}</div>

                <div class="card-body">

                    <form method="POST" action="{{ url('/editClassroom') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $classroom->name }}"  autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Horário') }}</label>

                            <div class="col-md-6">
                                <input id="schedule" type="schedule" class="form-control{{ $errors->has('schedule') ? ' is-invalid' : '' }}" name="schedule" value="{{ $classroom->schedule }}" data-mask="00:00">

                                @if ($errors->has('schedule'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('schedule') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sex" class="col-md-4 col-form-label text-md-right">{{ __('Dia da Semana') }}</label>

                            <div class="col-md-6">
                                <input id="day" type="day" class="form-control{{ $errors->has('day') ? ' is-invalid' : '' }}" name="day" value="{{ $classroom->day }}" >

                                @if ($errors->has('day'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('day') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Quantidade de Alunos') }}</label>

                            <div class="col-md-6">
                                <input id="size" type="size" class="form-control{{ $errors->has('size') ? ' is-invalid' : '' }}" name="size" value="{{ $classroom->size }}" >

                                @if ($errors->has('size'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('size') }}</strong>
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

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button name="classroom_id" value="{{ $classroom->id }}" type="submit" class="btn btn-primary">
                                    {{ __('Salvar alterações') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
