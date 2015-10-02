<?php

class Usuario extends BaseModel
{
	// Nome da tabela
	protected $table = 'usuarios';
	// Campos asseciveis
	protected $fillable = array('nome','email','login','senha');
	//
	// Regras do model
	public static $rules = array(
		'nome'  => 'required|min:3|max:50',
		'email' => 'required|min:7|max:50',
		'login' => 'required|min:3|max:10|unique:usuarios,login',
		'senha' => 'required|min:3|max:60',
	);
	// Relacionamentos
	public function coordenadores() {//
		return $this->hasMany('Coordenador', 'usuario_id');//hasMany?
	}
	public function questionadores() {//
		return $this->hasMany('Questionador', 'usuario_id');//hasMany?
	}
	public function especialistas() {//
		return $this->hasMany('Especialista', 'usuario_id');//hasMany?
	}
	public function contextos() {//
		return $this->belongsToMany('Contexto', 'usuarios_contextos', 'usuario_id', 'contexto_id');
	}
	// Corrigir regra de repetição - rescrever o metodo validade herdado
	public static function validate($data) {
		if(Request::getMethod() == 'PUT'){
			$id = $data['id'];
			self::$rules['login'] .= ",$id";
		}
		return Validator::make($data, self::$rules);
	}
}