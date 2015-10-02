<?php

class BaseModel extends Eloquent
{
	// Não criar os campos automáticos que armazenam a data de criação e atualização
	public $timestamps = false;

	public static function validate($data) {
		return Validator::make($data, static::$rules);
	}
}