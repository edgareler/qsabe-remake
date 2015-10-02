<?php

class PerguntaController extends \BaseController {
//
	protected $pergunta;
	//
	public function __construct(Pergunta $pergunta)
	{
		parent::__construct();
		$this->pergunta = $pergunta;
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// Variavel de busca
		$questionador_id = $pergunta = $descricao = $data_hora = null;
		// Ordenação
		$fields = array('questionador_id', 'pergunta', 'descricao', 'data_hora');
		$sort = in_array(Input::get('sort'), $fields) ? Input::get('sort') : 'pergunta';
		$order = Input::get('order') === 'desc' ? 'desc' : 'asc';
		// Consulta (select * FROM ... ORDER BY ....)
		$perguntas = $this->pergunta->orderBy($sort, $order);
		// Concatenando junto a consulta
		if(Input::has('questionador_id')) {
			$perguntas = $perguntas->where('questionador_id', 'LIKE', "%" . Input::get('questionador_id') . "%");
			$questionador_id = '&questionador_id=' . Input::get('questionador_id');
		}
		if(Input::has('pergunta')) {
			$perguntas = $perguntas->where('pergunta', 'LIKE', "%" . Input::get('pergunta') . "%");
			$pergunta = '&pergunta=' . Input::get('pergunta');
		}
		if(Input::has('descricao')) {
			$perguntas = $perguntas->where('descricao', 'LIKE', "%" . Input::get('descricao') . "%");
			$descricao = '&descricao=' . Input::get('descricao');
		}
		if(Input::has('data_hora')) {
			$perguntas = $perguntas->where('data_hora', 'LIKE', "%" . Input::get('data_hora') . "%");
			$data_hora = '&data_hora=' . Input::get('data_hora');
		}
		// Quantidade de itens a ser exibidos por página
		$perguntas = $perguntas->paginate(5);
		// Segurar filtros na paginação
		$pagination = $perguntas->appends(array(
			'questionador_id' => Input::get('questionador_id'),
			'pergunta' => Input::get('pergunta'),
			'descricao' => Input::get('descricao'),
			'data_hora' => Input::get('data_hora'),
			'sort' => Input::get('sort'),
			'order' => Input::get('order'),
		))->links();
		// Comunicação com a view
		return View::make('perguntas.index')
			->with(array(
				'questionador_id' => Input::get('questionador_id'),
				'pergunta' => Input::get('pergunta'),
				'descricao' => Input::get('descricao'),
				'data_hora' => Input::get('data_hora'),
				'perguntas' => $perguntas,
				'pagination' => $pagination,
				'str' => '&order=' . (Input::get('order') == 'asc' || null ? 'desc' : 'asc') . $questionador_id . $pergunta . $descricao . $data_hora
		));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('perguntas.create');
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
		$validator = Pergunta::validate($input);
		// trata os erros
		if($validator->fails()) {
			return Redirect::back()
				->withInput()
				->withErrors($validator)
				->with('error', Util::message('MSG001'));
		} else {
			$this->pergunta->create($input);
			return Redirect::to('pergunta')
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
		$pergunta = $this->pergunta->find($id);
		// trata os erros
		if(is_null($pergunta)){
			return Redirect::to('pergunta')
				->with('error', Util::message('MSG003'));
		}
		return View::make('perguntas.edit')
			->with('pergunta', $pergunta);
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
		$validator = Pergunta::validate($input);
		// trata os erros
		if($validator->fails()){
			return Redirect::back()
				->withInput()
				->withErrors($validator)
				->with('error', Util::message('MSG004'));
		} else {
			$this->pergunta->find($id)->update($input);
			return Redirect::to('pergunta')
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
			$this->pergunta->find($id)->delete();
			return Redirect::to('pergunta')
				->with('success', Util::message('MSG006'));
		} catch (Exception $e) {
			return Redirect::to('pergunta')
				->with('warning', Util::message('MSG007'));
		}
	}


}
