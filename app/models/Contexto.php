<?php

class Contexto extends BaseModel
{
	// Nome da tabela
	protected $table = 'contextos';
	// Campos asseciveis
	protected $fillable = array('nome');
	// Regras do model
	public static $rules = array(
		'nome' => 'required|min:3|max:50|unique:contextos,nome'
	);
	// Relacionamento
	/*public function usuarios() {
		// Auto relacionamento
	}*/
	public function especialistas() {
		return $this->belongsToMany('Especialista', 'especialistas_contextos', 'contexto_id', 'especialista_id');
	}
	public function perguntas() {
		return $this->belongsToMany('Pergunta', 'perguntas_contextos', 'contexto_id', 'pergunta_id');
	}
	// Corrigir regra de repetição - rescrever o metodo validade herdado
	public static function validate($data) {
		if(Request::getMethod() == 'PUT'){
			$id = $data['id'];
			self::$rules['nome'] .= ",$id";
		}
		return Validator::make($data, self::$rules);
	}
}