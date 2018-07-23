@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Criar conta') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome completo ') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-mail ') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

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
                                  <option name="sex" value="{{ old('sex') }}" selected>{{ old('sex') }}</option>
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
                                <input id="phone" type="phone" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" data-mask="(00) 00000-0000" required>

                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback">
                                        <strong>Telefone inválido</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cpf" class="col-md-4 col-form-label text-md-right">{{ __('CPF') }}</label>

                            <div class="col-md-6">
                                <input id="cpf" type="cpf" class="form-control{{ $errors->has('cpf') ? ' is-invalid' : '' }}" name="cpf" value="{{ old('cpf') }}" data-mask="000.000.000-00" required>

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
                                <input id="course" type="course" class="form-control{{ $errors->has('course') ? ' is-invalid' : '' }}" name="course" value="{{ old('course') }}" required>

                                @if ($errors->has('course'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('course') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="profile" class="col-md-4 col-form-label text-md-right">{{ __('Perfil no Facebook') }}</label>

                            <div class="col-md-6">
                                <input id="profile" type="profile" class="form-control{{ $errors->has('profile') ? ' is-invalid' : '' }}" name="profile" value="{{ old('profile') }}" required>

                                @if ($errors->has('profile'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('profile') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="colar" class="col-md-4 col-form-label text-md-right">{{ __('Colar') }}</label>

                            <div class="col-md-6">

                                <select id="colar" name="colar" class="custom-select {{ $errors->has('colar') ? ' is-invalid' : '' }}">
                                  <option name="colar" value="Transparente" selected>Transparente</option>
                                  <option name="colar" value="Transparente">Transparente</option>
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
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Senha') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar senha') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>



                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary float-right">
                                    {{ __('Criar conta') }}
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
