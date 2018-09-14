@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Registrar Aula') }}</div>

                <div class="card-body">
                    <form method="POST" action={{ url('/addClassToClassroom') }}>
                        @csrf
                        <div class="row">
                            <div class="col-12 col-md-9 d-flex flex-column">
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Data: ') }}</label>

                                    <div class="col-md-6">
                                        <input id="date" type="text" class="form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" name="class_data[date]" value="{{ old('date') }}" data-mask="00/00/0000" autofocus required>

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
                                        <textarea id="content" type="text" class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" name="class_data[content]" value="{{ old('content') }}" required></textarea>

                                        @if ($errors->has('content'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('content') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                            <div class="col-11 col-md-8 p-0 p-md-2 d-flex flex-column">
                                <h3 class="text-center">Presença</h3>

                                @if (session('error'))
                                            <span class="alert alert-danger">
                                                <strong>{{ session('error') }}</strong>
                                            </span>
                                @else
                                
                                    @foreach($students as $student)
                                        <div class="row pb-2 pt-2 border-bottom align-items-center pb-md-2 mt-md-2 ">
                                            <div class="col-2 col-md-2">
                                                <input id="{{ $student->id }}"name="attendence[{{ $student->id }}]" class="float-left" type="checkbox">
                                                <input id="{{ $student->id }}b" name="attendence[{{ $student->id }}]" value="0" type="hidden" disabled>
                                            </div>
                                            <div class="col-10 mt-2 col-md-10 float-left">
                                                <p>{{ $student->name }}</p>
                                            </div>
                                            
                                        </div>
                                    @endforeach

                                @endif
                            </div>
                            
                        </div>

                            <div class="form-group row mb-0 float-right">
                                <div class="col-md-6">
                                    <button id="submit_button" name="classroom_id" value="{{ $classroom->id }}" type="submit" class="btn btn-primary">
                                        {{ __('Registrar Aula') }}
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
