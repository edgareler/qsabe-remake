<?php

class UsuarioController extends \BaseController {

    //
    protected $usuario;

    //
    public function __construct(Usuario $usuario) {
        parent::__construct();
        $this->usuario = $usuario;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        // Variavel de busca
        $nome = $email = $login = null;
        // Ordenação
        $fields = array('nome', 'email', 'login');
        $sort = in_array(Input::get('sort'), $fields) ? Input::get('sort') : 'nome';
        $order = Input::get('order') === 'desc' ? 'desc' : 'asc';
        // Consulta (select * FROM usuarios ORDER BY nome, email, login)
        $usuarios = $this->usuario->orderBy($sort, $order);
        // Concatenando junto a consulta
        if (Input::has('nome')) {
            $usuarios = $usuarios->where('nome', 'LIKE', "%" . Input::get('nome') . "%");
            $nome = '&nome=' . Input::get('nome');
        }
        if (Input::has('email')) {
            $usuarios = $usuarios->where('email', 'LIKE', "%" . Input::get('email') . "%");
            $email = '&email=' . Input::get('email');
        }
        if (Input::has('login')) {
            $usuarios = $usuarios->where('login', 'LIKE', "%" . Input::get('login') . "%");
            $login = '&login=' . Input::get('login');
        }
        // Quantidade de itens a ser exibidos por página
        $usuarios = $usuarios->paginate(5);
        // Segurar filtros na paginação
        $pagination = $usuarios->appends(array(
                    'nome' => Input::get('nome'),
                    'email' => Input::get('email'),
                    'login' => Input::get('login'),
                    'sort' => Input::get('sort'),
                    'order' => Input::get('order'),
                ))->links();
        // Comunicação com a view
        return View::make('usuarios.index')
                        ->with(array(
                            'nome' => Input::get('nome'),
                            'email' => Input::get('email'),
                            'login' => Input::get('login'),
                            'usuarios' => $usuarios,
                            'pagination' => $pagination,
                            'str' => '&order=' . (Input::get('order') == 'asc' || null ? 'desc' : 'asc') . $nome . $email . $login
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return View::make('usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        // Capiturar todos os campos
        $input = Input::all();
        // Busca validação no model
        $validator = Usuario::validate($input);
        // trata os erros
        if ($validator->fails()) {
            return Redirect::back()
                            ->withInput()
                            ->withErrors($validator)
                            ->with('error', Util::message('MSG001'));
        } else {
            $this->usuario->create($input);
            return Redirect::to('usuario')
                            ->with('success', Util::message('MSG002'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        // Pesquisa id
        $usuario = $this->usuario->find($id);
        // trata os erros
        if (is_null($usuario)) {
            return Redirect::to('usuario')
                            ->with('error', Util::message('MSG003'));
        }
        return View::make('usuarios.edit')
                        ->with('usuario', $usuario);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        // Capiturar todos os campos
        $input = Input::all();
        // informar o id para o metodo unique
        $input['id'] = $id;
        // Busca validação no model
        $validator = Usuario::validate($input);
        // trata os erros
        if ($validator->fails()) {
            return Redirect::back()
                            ->withInput()
                            ->withErrors($validator)
                            ->with('error', Util::message('MSG004'));
        } else {
            $this->usuario->find($id)->update($input);
            return Redirect::to('usuario')
                            ->with('success', Util::message('MSG005'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        // trata os erros
        try {
            $this->usuario->find($id)->delete();
            return Redirect::to('usuario')
                            ->with('success', Util::message('MSG006'));
        } catch (Exception $e) {
            return Redirect::to('usuario')
                            ->with('warning', Util::message('MSG007'));
        }
    }

    public static function listaUsuarios() {
        $usuarios = DB::table('usuarios')->orderBy('nome', 'asc')->get();

        return Response::json($usuarios);
    }

    public static function getUsuario() {
        return Response::json(array('userId' => Session::get('user.id', 2),
                                    'userName' => Session::get('user.name', 'Edgar'),
                                    'userIcon' => Session::get('user.icon', 'avatar.jpg')));
    }

    public static function mudarUsuario($id) {
        $usuario = DB::table('usuarios')->where('id', $id)->first();

        Session::put('user.id', $usuario->id);
        Session::put('user.name', $usuario->nome);
        Session::put('user.icon', $usuario->icone);

        return Redirect::to('/');
    }

}
