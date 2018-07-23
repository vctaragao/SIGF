@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Atualizar informações') }}</div>

                <div class="card-body">
                    <form method="POST" action={{ url('/studentEdit') }}>
                        @csrf

                         @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif


                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome completo') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $user->name }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sex" class="col-md-4 col-form-label text-md-right">{{ __('Sexo') }}</label>

                            <div class="col-md-6">

                                 <select id="sex" name="sex" class="custom-select {{ $errors->has('sex') ? ' is-invalid' : '' }}">
                                  <option name="sex" value="{{ old('sex') }}" selected>{{ $user->sex }}</option>
                                  <option name="sex" value="Masculino">Masculino</option>
                                  <option name="sex" value="Feminino">Feminino</option>
                                  <option name="sex" value="Prefiro não dizer">Prefiro não dizer</option>
                                  <option name="sex" value="OUtro">Outro</option>
                                </select>

                                @if ($errors->has('sex'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('sex') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Numero de celular') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="phone" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ $user->phone }}" required>

                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cpf" class="col-md-4 col-form-label text-md-right">{{ __('CPF') }}</label>

                            <div class="col-md-6">
                                <input id="cpf" type="cpf" class="form-control{{ $errors->has('cpf') ? ' is-invalid' : '' }}" name="cpf" value="{{ $user->cpf }}" required>

                                @if ($errors->has('cpf'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('cpf') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="course" class="col-md-4 col-form-label text-md-right">{{ __('Curso') }}</label>

                            <div class="col-md-6">
                                <input id="course" type="course" class="form-control{{ $errors->has('course') ? ' is-invalid' : '' }}" name="course" value="{{ $user->course }}" required>

                                @if ($errors->has('course'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('course') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="colar" class="col-md-4 col-form-label text-md-right">{{ __('Colar') }}</label>

                            <div class="col-md-6">
                                
                                <select id="colar" name="colar" class="custom-select {{ $errors->has('colar') ? ' is-invalid' : '' }}">
                                  <option name="colar" value="{{ old('colar') }}" selected>{{ $user->colar }}</option>
                                  <option name="colar" value="Tranparente">Tranparente</option>
                                  <option name="colar" value="Azul">Azul</option>
                                  <option name="colar" value="Azul Avançada">Azul Avançada</option>
                                  <option name="colar" value="Preto">Preto</option>
                                  <option name="colar" value="Preto Avançada">Preto Avançada</option>
                                  <option name="colar" value="Vermelho">Vermelho</option>
                                </select>

                                @if ($errors->has('colar'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('colar') }}</strong>
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
                                <button name="user_edit" value={{ $user->id }} type="submit" class="btn btn-primary">
                                    {{ __('Atualizar') }}
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
