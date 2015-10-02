@extends('layout')

@section('content')
		<h4>Usuarios</h4>
		{{ link_to('usuario/create', 'Novo') }}
	<!-- Parte da busca -->
	{{ Form::open(array('url' => 'usuario', 'method' => 'get')) }}
		{{ Form::text('nome', $nome, array('placeholder' => 'Nome')) }}
		{{ Form::text('email', $email, array('placeholder' => 'Email')) }}
		{{ Form::text('login', $login, array('placeholder' => 'Login')) }}
		{{ Form::button('Pesquisar', array('type' => 'submit')) }}
	{{ Form::close() }}
	@if($usuarios->getItems())
	    <table border="1">
	    	<thead>
	    		<tr>
	    			<th><a href="{{ URL::to('usuario?sort=nome' . $str) }}">Nome</a></th>
	    			<th><a href="{{ URL::to('usuario?sort=email' . $str) }}">Email</a></th>
	    			<th><a href="{{ URL::to('usuario?sort=senha' . $str) }}">Login</a></th>
	    			<th colspan="2">Ações</th>
	    		</tr>
	    	</thead>
	    	<tbody>
	    		@foreach($usuarios as $usuario)
	    		<tr>
	    			<td>{{ e($usuario->nome) }}</td>
	    			<td>{{ e($usuario->email) }}</td>
	    			<td>{{ e($usuario->login) }}</td>
	    			<td>{{ link_to('usuario/' . $usuario->id . '/edit', 'editar') }}</td>
	    			<td>
	    				{{ Form::open(array('url' => 'usuario/' . $usuario->id, 'method' => 'delete', 'data-confirm' => 'Deseja excluir o registro selecionado?')) }}
							{{ Form::button('excluir', array('type' => 'submit')) }}
						{{ Form::close() }}
	    			</td>
	    		</tr>
	    		@endforeach
	    	</tbody>
	    </table>
	    {{ $pagination }}
		<p>Exibindo de {{ $usuarios->getFrom() }} até {{ $usuarios->getTo() }} de {{ $usuarios->getTotal() }} registros.</p>
	@else
		<p>{{ Util::message('MSG008') }}</p>
	@endif
@stop