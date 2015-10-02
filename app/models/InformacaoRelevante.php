<?php

class InformacaoRelevante extends BaseModel
{
	// Nome da tabela
	protected $table = 'informacoes_relevantes';
	// Campos asseciveis
	protected $fillable = array('Informacao');
	// Regras do model
	public static $rules = array(
		'Informacao'  => 'required|min:10|max:50'
	);
	// Relacionamento
	public function respostas() {
		return $this->belongsTo('Resposta');
	}
}