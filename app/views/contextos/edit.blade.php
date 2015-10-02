@extends('layout')

@section('content')
		<h4>Alterar Contexto</h4>
		{{ link_to('contexto', 'Voltar') }}
	{{ Form::open(array('url' => 'contexto/' . $contexto->id, 'method' => 'put')) }}
		{{ Form::label('nome', '*Nome') }}
		{{ Form::text('nome', Input::old('nome', $contexto->nome)) }}
		{{ $errors->first('nome', '<span class="error">:message</span>') }}
		
		{{ Form::submit('Alterar') }}
	{{ Form::close() }}
@stop