@extends('layout')

@section('content')
		<h4>Contextos</h4>
		{{ link_to('contexto/create', 'Novo') }}
	<!-- Parte da busca -->
	{{ Form::open(array('url' => 'contexto', 'method' => 'get')) }}
		{{ Form::text('nome', $nome, array('placeholder' => 'Nome')) }}
		{{ Form::button('Pesquisar', array('type' => 'submit')) }}
	{{ Form::close() }}
	@if($contextos->getItems())
	    <table border="1">
	    	<thead>
	    		<tr>
	    			<th><a href="{{ URL::to('contexto?sort=nome' . $str) }}">Nome</a></th>
	    			<th colspan="2">Ações</th>
	    		</tr>
	    	</thead>
	    	<tbody>
	    		@foreach($contextos as $contexto)
	    		<tr>
	    			<td>{{ e($contexto->nome) }}</td>
	    			<td>{{ link_to('contexto/' . $contexto->id . '/edit', 'editar') }}</td>
	    			<td>
	    				{{ Form::open(array('url' => 'contexto/' . $contexto->id, 'method' => 'delete', 'data-confirm' => 'Deseja excluir o registro selecionado?')) }}
							{{ Form::button('excluir', array('type' => 'submit')) }}
						{{ Form::close() }}
	    			</td>
	    		</tr>
	    		@endforeach
	    	</tbody>
	    </table>
	    {{ $pagination }}
		<p>Exibindo de {{ $contextos->getFrom() }} até {{ $contextos->getTo() }} de {{ $contextos->getTotal() }} registros.</p>
	@else
		<p>{{ Util::message('MSG008') }}</p>
	@endif
@stop