@extends('layout')

@section('content')
		<h4>Adicionar Usuarios</h4>
		{{ link_to('usuario', 'Voltar') }}
                
	{{ Form::open(array('url' => 'usuario')) }}
		{{ Form::label('nome', '*Nome') }}
		{{ Form::text('nome', Input::old('nome')) }}
		{{ $errors->first('nome', '<span class="error">:message</span>') }}

		{{ Form::label('email', '*Email') }}
		{{ Form::text('email', Input::old('email')) }}
		{{ $errors->first('email', '<span class="error">:message</span>') }}

		{{ Form::label('login', '*Login') }}
		{{ Form::text('login', Input::old('login')) }}
		{{ $errors->first('login', '<span class="error">:message</span>') }}

		{{ Form::label('senha', '*Senha') }}
		{{ Form::text('senha', Input::old('senha')) }}
		{{ $errors->first('senha', '<span class="error">:message</span>') }}

		{{ Form::submit('Salvar') }}
	{{ Form::close() }}
@stop