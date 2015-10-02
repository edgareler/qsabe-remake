@extends('main')

@section('content')
    <header>
		<h4>Adicionar Contexto</h4>
		{{ link_to('contexto', 'Voltar') }}
	</header>
	{{ Form::open(array('url' => 'contexto')) }}
		{{ Form::label('nome', '*Nome') }}
		{{ Form::text('nome', Input::old('nome')) }}
		{{ $errors->first('nome', '<span class="error">:message</span>') }}
		
		{{ Form::submit('Salvar') }}
	{{ Form::close() }}
@stop