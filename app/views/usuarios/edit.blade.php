@extends('layout')

@section('content')
	<header>
		<h4>Alterar Usuarios</h4>
		{{ link_to('usuario', 'Voltar') }}
	</header>
	{{ Form::open(array('url' => 'usuario/' . $usuario->id, 'method' => 'put')) }}
		{{ Form::label('nome', '*Nome') }}
		{{ Form::text('nome', Input::old('nome', $usuario->nome)) }}
		{{ $errors->first('nome', '<span class="error">:message</span>') }}

		{{ Form::label('email', '*Email') }}
		{{ Form::text('email', Input::old('email', $usuario->email)) }}
		{{ $errors->first('email', '<span class="error">:message</span>') }}

		{{ Form::label('login', '*Login') }}
		{{ Form::text('login', Input::old('login', $usuario->login)) }}
		{{ $errors->first('login', '<span class="error">:message</span>') }}

		{{ Form::label('senha', '*Senha') }}
		{{ Form::text('senha', Input::old('senha', $usuario->senha)) }}
		{{ $errors->first('senha', '<span class="error">:message</span>') }}

		{{ Form::submit('Alterar') }}
	{{ Form::close() }}
@stop