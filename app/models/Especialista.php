<?php

class Especialista extends BaseModel
{
	// Nome da tabela
	protected $table = 'especialistas';
	// Campos asseciveis
	protected $fillable = array('reputacao');
	// Regras do model
	public static $rules = array(
		'reputacao'  => 'min:3|max:50'
	);
	// Relacionamento
	public function usuarios() {//
		return $this->belongsTo('Usuario', 'usuario_id');
	}
	public function contextos() {
		return $this->belongsToMany('Contexto', 'especialistas_contextos', 'especialista_id', 'contexto_id');
	}
	public function respostas() {
		return $this->belongsToMany('Resposta', 'respostas_especialistas', 'especialista_id', 'resposta_id');
	}

}