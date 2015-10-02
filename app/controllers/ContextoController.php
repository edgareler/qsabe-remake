<?php

class ContextoController extends BaseController {
	//
	protected $contexto;
	//
	public function __construct(Contexto $contexto)
	{
		parent::__construct();
		$this->contexto = $contexto;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// Variavel de busca
		$nome = null;
		// Ordenação
		$sort = 'nome';
		$order = Input::get('order') === 'desc' ? 'desc' : 'asc';
		// Consulta (select * FROM contextos ORDER BY nome)
		$contextos = $this->contexto->orderBy($sort, $order);
		// Concatenando junto a consulta
		if(Input::has('nome')) {
			// Adicionando clausura where
			$contextos = $contextos->where('nome', 'LIKE', "%" . Input::get('nome') . "%");
			$nome = '&nome=' . Input::get('nome');
		}
		// Quantidade de itens a ser exibidos por página
		$contextos = $contextos->paginate(5);
		// Segurar filtros na paginação
		$pagination = $contextos->appends(array(
			'nome' => Input::get('nome'),
			'sort' => Input::get('sort'),
			'order' => Input::get('order'),
		))->links();
		// Comunicação com a view
		return View::make('contextos.index')
			->with(array(
				'nome' => Input::get('nome'),
				'contextos' => $contextos,
				'pagination' => $pagination,
				'str' => '&order=' . (Input::get('order') == 'asc' || null ? 'desc' : 'asc') . $nome
		));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('contextos.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// Capiturar todos os campos
		$input = Input::all();
		// Busca validação no model
		$validator = Contexto::validate($input);
		// trata os erros
		if($validator->fails()) {
			return Redirect::back()
				->withInput()
				->withErrors($validator)
				->with('error', Util::message('MSG001'));
		} else {
			$this->contexto->create($input);
			return Redirect::to('contexto')
				->with('success', Util::message('MSG002'));
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		// Pesquisa id
		$contexto = $this->contexto->find($id);
		// trata os erros
		if(is_null($contexto)){
			return Redirect::to('contexto')
				->with('error', Util::message('MSG003'));
		}
		return View::make('contextos.edit')
			->with('contexto', $contexto);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		// Capiturar todos os campos
		$input = Input::all();
		// informar o id para o metodo unique
		$input['id'] = $id;
		// Busca validação no model
		$validator = Contexto::validate($input);
		// trata os erros
		if($validator->fails()){
			return Redirect::back()
				->withInput()
				->withErrors($validator)
				->with('error', Util::message('MSG004'));
		} else {
			$this->contexto->find($id)->update($input);
			return Redirect::to('contexto')
				->with('success', Util::message('MSG005'));
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		// trata os erros
		try {
			$this->contexto->find($id)->delete();
			return Redirect::to('contexto')
				->with('success', Util::message('MSG006'));
		} catch (Exception $e) {
			return Redirect::to('contexto')
				->with('warning', Util::message('MSG007'));
		}
	}


}
