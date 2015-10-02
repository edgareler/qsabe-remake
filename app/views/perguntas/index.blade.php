@extends('layout')

@section('content')
		<h4>Perguntas</h4>
		{{ link_to('pergunta/create', 'Novo') }}
                
	<!-- Parte da busca -->
	{{ Form::open(array('url' => 'pergunta', 'method' => 'get')) }}
		{{ Form::text('questionador_id', $questionador_id, array('placeholder' => 'Id do Questionador')) }}
		{{ Form::text('pergunta', $pergunta, array('placeholder' => 'Pergunta')) }}
		{{ Form::text('descricao', $descricao, array('placeholder' => 'Descrição')) }}
		{{ Form::text('data_hora', $data_hora, array('placeholder' => 'Login')) }}
		{{ Form::button('Pesquisar', array('type' => 'submit')) }}
	{{ Form::close() }}
	@if($perguntas->getItems())
	    <table border="1">
	    	<thead>
	    		<tr>
	    			<th><a href="{{ URL::to('pergunta?sort=questionador_id' . $str) }}">Questionador</a></th>
	    			<th><a href="{{ URL::to('pergunta?sort=pergunta' . $str) }}">Pergunta</a></th>
	    			<th><a href="{{ URL::to('pergunta?sort=descricao' . $str) }}">Descrição</a></th>
	    			<th><a href="{{ URL::to('pergunta?sort=data_hora' . $str) }}">Data/Hora</a></th>
	    			<th colspan="2">Ações</th>
	    		</tr>
	    	</thead>
	    	<tbody>
	    		@foreach($perguntas as $pergunta)
	    		<tr>
	    			<td>{{ e($pergunta->questionador_id) }}</td>
	    			<td>{{ e($pergunta->pergunta) }}</td>
	    			<td>{{ e($pergunta->descricao) }}</td>
	    			<td>{{ e($pergunta->data_hora) }}</td>
	    			<td>{{ link_to('pergunta/' . $pergunta->id . '/edit', 'editar') }}</td>
	    			<td>
	    				{{ Form::open(array('url' => 'pergunta/' . $pergunta->id, 'method' => 'delete', 'data-confirm' => 'Deseja excluir o registro selecionado?')) }}
							{{ Form::button('excluir', array('type' => 'submit')) }}
						{{ Form::close() }}
	    			</td>
	    		</tr>
	    		@endforeach
	    	</tbody>
	    </table>
	    {{ $pagination }}
		<p>Exibindo de {{ $perguntas->getFrom() }} até {{ $perguntas->getTo() }} de {{ $perguntas->getTotal() }} registros.</p>
	@else
		<p>{{ Util::message('MSG008') }}</p>
	@endif
@stop