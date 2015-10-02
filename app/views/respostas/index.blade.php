@extends('main')

@section('content')
		<h4>Respostas</h4>
		{{ link_to('resposta/create', 'Novo') }}
	<!-- Parte da busca -->
	{{ Form::open(array('url' => 'resposta', 'method' => 'get')) }}
		{{ Form::text('pergunta_id', $pergunta_id, array('placeholder' => 'Id da Pergunta')) }}
		{{ Form::text('resposta', $resposta, array('placeholder' => 'Resposta')) }}
		{{ Form::text('data_hora', $data_hora, array('placeholder' => 'Data/Hora')) }}
		{{ Form::select('nota', array('' => 'Nota', 1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 10 => 10,), $nota) }}
		{{ Form::button('Pesquisar', array('type' => 'submit')) }}
	{{ Form::close() }}
	@if($respostas->getItems())
	    <table border="1">
	    	<thead>
	    		<tr>
	    			<th><a href="{{ URL::to('resposta?sort=pergunta_id' . $str) }}">id da Pergunta</a></th>
	    			<th><a href="{{ URL::to('resposta?sort=resposta' . $str) }}">Resposta</a></th>
	    			<th><a href="{{ URL::to('resposta?sort=data_hora' . $str) }}">Data/Hora</a></th>
	    			<th><a href="{{ URL::to('resposta?sort=nota' . $str) }}">Nota</a></th>
	    			<th colspan="2">Ações</th>
	    		</tr>
	    	</thead>
	    	<tbody>
	    		@foreach($respostas as $resposta)
	    		<tr>
	    			<td>{{ e($resposta->pergunta_id) }}</td>
	    			<td>{{ e($resposta->resposta) }}</td>
	    			<td>{{ e($resposta->data_hora) }}</td>
	    			<td>{{ e($resposta->nota) }}</td>
	    			<td>{{ link_to('resposta/' . $resposta->id . '/edit', 'editar') }}</td>
	    			<td>
	    				{{ Form::open(array('url' => 'resposta/' . $resposta->id, 'method' => 'delete', 'data-confirm' => 'Deseja excluir o registro selecionado?')) }}
							{{ Form::button('excluir', array('type' => 'submit')) }}
						{{ Form::close() }}
	    			</td>
	    		</tr>
	    		@endforeach
	    	</tbody>
	    </table>
	    {{ $pagination }}
		<p>Exibindo de {{ $respostas->getFrom() }} até {{ $respostas->getTo() }} de {{ $respostas->getTotal() }} registros.</p>
	@else
		<p>{{ Util::message('MSG008') }}</p>
	@endif
@stop