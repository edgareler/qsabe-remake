@extends('layout')

@section('content')
		<h4>Alterar Perguntas</h4>
		{{ link_to('pergunta', 'Voltar') }}
                
	{{ Form::open(array('url' => 'pergunta/' . $pergunta->id, 'method' => 'put')) }}
		{{ Form::label('questionador_id', '*Id do Questionador') }}
		{{ Form::text('questionador_id', Input::old('questionador_id', $pergunta->questionador_id)) }}
		{{ $errors->first('questionador_id', '<span class="error">:message</span>') }}

		{{ Form::label('pergunta', '*Pergunta') }}
		{{ Form::text('pergunta', Input::old('pergunta', $pergunta->pergunta)) }}
		{{ $errors->first('pergunta', '<span class="error">:message</span>') }}

		{{ Form::label('descricao', '*Descrição') }}
		{{ Form::text('descricao', Input::old('descricao', $pergunta->descricao)) }}
		{{ $errors->first('descricao', '<span class="error">:message</span>') }}

		{{ Form::label('data_hora', '*Data/Hora') }}
		{{ Form::text('data_hora', Input::old('data_hora', $pergunta->data_hora)) }}
		{{ $errors->first('data_hora', '<span class="error">:message</span>') }}

		{{ Form::submit('Alterar') }}
	{{ Form::close() }}
@stop