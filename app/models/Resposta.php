<?php

class Resposta extends BaseModel
{
	// Nome da tabela
	protected $table = 'respostas';
	// Campos asseciveis
	protected $fillable = array('perguntas_id','resposta','data_hora','correta','nota');
	// Regras do model
	public static $rules = array(
		'pergunta_id'  => 'required',
		'resposta' => 'required|min:10|max:100',
		'data_hora' => 'required',
		'correta' => '>required|in:Sim,Não',
		'nota' => 'integer|in:1,2,3,4,5,6,7,8,9,10',
	);
	// Relacionamento
	public function perguntas()	{
		return $this->belongsTo('Pergunta');
	}
	public function especialistas()	{
		return $this->belongsToMany('Especialista', 'respostas_especialistas', 'resposta_id', 'especialista_id');
	}
	public function informacoes_relevantes() {
		return $this->hasMany('InformacaoRelevante', 'resposta_id', 'id');
	}
}