<?php

class RespostaController extends \BaseController {

	//
	protected $resposta;
	//
	public function __construct(Resposta $resposta)
	{
		parent::__construct();
		$this->resposta = $resposta;
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// Variavel de busca
		$pergunta_id = $resposta = $data_hora = $correta = $nota = null;
		// Ordenação
		$fields = array('pergunta_id', 'resposta', 'data_hora', 'correta', 'nota');
		$sort = in_array(Input::get('sort'), $fields) ? Input::get('sort') : 'resposta';
		$order = Input::get('order') === 'desc' ? 'desc' : 'asc';
		// Consulta (select * FROM .....  ORDER BY .....)
		$respostas = $this->resposta->orderBy($sort, $order);
		// Concatenando junto a consulta
		if(Input::has('pergunta_id')) {
			$respostas = $respostas->where('pergunta_id', 'LIKE', "%" . Input::get('pergunta_id') . "%");
			$pergunta_id = '&pergunta_id=' . Input::get('pergunta_id');
		}
		if(Input::has('resposta')) {
			$respostas = $respostas->where('resposta', 'LIKE', "%" . Input::get('resposta') . "%");
			$resposta = '&resposta=' . Input::get('resposta');
		}
		if(Input::has('data_hora')) {
			$respostas = $respostas->where('data_hora', 'LIKE', "%" . Input::get('data_hora') . "%");
			$data_hora = '&data_hora=' . Input::get('data_hora');
		}
		if(Input::has('correta') && is_numeric(Input::get('correta'))) {
			$respostas = $respostas->where('correta', '=', Input::get('correta'));
			$correta = '&correta=' . Input::get('correta');
		}
		if(Input::has('nota') && is_numeric(Input::get('nota'))) {
			$respostas = $respostas->where('nota', '=', Input::get('nota'));
			$nota = '&nota=' . Input::get('nota');
		}
		// Quantidade de itens a ser exibidos por página
		$respostas = $respostas->paginate(5);
		// Segurar filtros na paginação
		$pagination = $respostas->appends(array(
			'pergunta_id' => Input::get('pergunta_id'),
			'resposta' => Input::get('resposta'),
			'data_hora' => Input::get('data_hora'),
			'correta' => Input::get('correta'),
			'nota' => Input::get('nota'),
			'sort' => Input::get('sort'),
			'order' => Input::get('order'),
		))->links();
		// Comunicação com a view
		return View::make('respostas.index')
			->with(array(
				'pergunta_id' => Input::get('pergunta_id'),
				'resposta' => Input::get('resposta'),
				'data_hora' => Input::get('data_hora'),
				'correta' => Input::get('correta'),
				'nota' => Input::get('nota'),
				'respostas' => $respostas,
				'pagination' => $pagination,
				'str' => '&order=' . (Input::get('order') == 'asc' || null ? 'desc' : 'asc') . $pergunta_id . $resposta . $data_hora . $correta . $nota
		));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('respostas.create');
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
		$validator = Resposta::validate($input);
		// trata os erros
		if($validator->fails()) {
			return Redirect::back()
				->withInput()
				->withErrors($validator)
				->with('error', Util::message('MSG001'));
		} else {
			$inputs = array(
				'pergunta_id' => Input::get('pergunta_id'),
				'resposta' => Input::get('resposta'),
				//'data_hora' => Util::toMySQL(Input::get('data_hora')),
				'data_hora' => Input::get('data_hora'),
				'correta' => Input::get('correta'),
				'nota' => Input::get('nota'),
			);
			$this->resposta->create($inputs);
			$this->pergunta()->sync(Input::get('pergunta_id'));
			return Redirect::to('resposta')
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
		$resposta = $this->resposta->find($id);
		// trata os erros
		if(is_null($resposta)){
			return Redirect::to('resposta')
				->with('error', Util::message('MSG003'));
		}
		$pergunta_id = $pergunta->id;
		return View::make('respostas.edit')
			->with(array(
				'resposta', $resposta,
				'pergunta_id' => $pergunta_id,
			));
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
		$validator = Resposta::validate($input);
		// trata os erros
		if($validator->fails()){
			return Redirect::back()
				->withInput()
				->withErrors($validator)
				->with('error', Util::message('MSG004'));
		} else {
			$inputs = array(
				'pergunta_id' => Input::get('pergunta_id'),
				'resposta' => Input::get('resposta'),
				//'data_hora' => Util::toMySQL(Input::get('data_hora')),
				'data_hora' => Input::get('data_hora'),
				'correta' => Input::get('correta'),
				'nota' => Input::get('nota'),
			);

			$this->resposta->find($id)->update($inputs);
			$this->resposta->find($id)->pergunta()->sync(Input::get('pergunta_id'));

			return Redirect::to('resposta')
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
			$this->resposta->find($id)->delete();
			return Redirect::to('resposta')
				->with('success', Util::message('MSG006'));
		} catch (Exception $e) {
			return Redirect::to('respostas')
				->with('warning', Util::message('MSG007'));
		}
	}


}
