@extends('main')

@section('content')
		<h4>Alterar Respostas</h4>
		{{ link_to('resposta', 'Voltar') }}
	{{ Form::open(array('url' => 'resposta/' . $resposta->id, 'method' => 'put')) }}
		{{ Form::label('pergunta_id', '*Id da Pergunta') }}
		{{ Form::text('pergunta_id', Input::old('pergunta_id', $resposta->pergunta_id)) }}
		{{ $errors->first('pergunta_id', '<span class="error">:message</span>') }}

		{{ Form::label('resposta', '*Resposta') }}
		{{ Form::text('emrespostaail', Input::old('resposta', $resposta->resposta)) }}
		{{ $errors->first('emrespostaail', '<span class="error">:message</span>') }}

		{{ Form::label('data_hora', '*Data/Hora') }}
		{{ Form::text('data_hora', Input::old('data_hora', $resposta->data_hora)) }}
		{{ $errors->first('data_hora', '<span class="error">:message</span>') }}

		{{ Form::label('nota', '*Nota') }}
		{{ Form::select('nota', array('' => 'Nota', 1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 10 => 10,), Input::old('nota', $resposta->nota)) }}
		{{ $errors->first('nota', '<span class="error">:message</span>') }}

		{{ Form::submit('Alterar') }}
	{{ Form::close() }}
@stop