<?php

class Questionador extends BaseModel
{
	// Nome da tabela
	protected $table = 'questionadores';
	// Relacionamento
	public function usuarios() {
		return $this->belongsTo('Usuario', 'usuario_id');
	}
	public function perguntas() {
		return $this->hasMany('Resposta', 'questionador_id', 'usuario_id');
	}
}