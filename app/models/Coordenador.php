<?php

class Coordenador extends BaseModel
{
	// Nome da tabela
	protected $table = 'coordenadores';
	// Relacionamento
	public function usuarios() { //
		return $this->belongsTo('Usuario', 'usuario_id');
	}
}