<?php

class Pergunta extends BaseModel
{
	// Nome da tabela
	protected $table = 'perguntas';
	// Campos asseciveis
	protected $fillable = array('questionador_id','pergunta','descricao','data_hora');
	// Regras do model
	public static $rules = array(
		'questionador_id'  => 'required',
		'pergunta' => 'required|min:2|max:50|unique:perguntas,pergunta',
		'descricao' => 'required|min:10|max:50',
		'data_hora' => 'required',
	);
	// Relacionamento
	public function questionadores() {
		return $this->belongsTo('Questionador');
	}
	public $includes = array('respostas');
	public function respostas() {
		return $this->hasMany('Resposta', 'pergunta_id', 'id');
	}
	public function contextos()	{
		return $this->belongsToMany('Contexto', 'perguntas_contextos', 'pergunta_id', 'contexto_id');
	}
	// Corrigir regra de repetição - rescrever o metodo validade herdado
	public static function validate($data) {
		if(Request::getMethod() == 'PUT'){
			$id = $data['id'];
			self::$rules['pergunta'] .= ",$id";
		}
		return Validator::make($data, self::$rules);
	}
}