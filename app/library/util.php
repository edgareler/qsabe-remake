<?php

class Util {
	// Método que trata as menssagens
	public static function message($string) {
		$json = json_decode(file_get_contents(public_path() . '/message.json'));
		return $json->$string;
	}
	// Método que trata a data
	public static function toView($value) {
		return date('d/m/Y H:i:s', strtotime($value));
	}
	// Método que salva a data no formato do banco
	public static function toMySQL($value) {
		$data_time = explode(' ', $value);
		$date = explode('/', $data_time[0]);
		return $date[2] . '-' . $date[1] . '-' . $date[0] . ' ' . $data_time[1];
	}
	// Método que corta textos longos
	public static function truncate($string) {
		return current(explode('\n', wordwrap($string, 70, ' ...\n')));
	}
}