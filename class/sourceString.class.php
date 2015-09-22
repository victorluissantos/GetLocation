<?php
Class sourceString {

	public function after ($tthis, $inthat)
	{
	    if (!is_bool(strpos($inthat, $tthis)))
	    return substr($inthat, strpos($inthat,$tthis)+strlen($tthis));
	}

	public function after_last ($tthis, $inthat)
	{
	    if (!is_bool(strrevpos($inthat, $tthis)))
	    return substr($inthat, strrevpos($inthat, $tthis)+strlen($tthis));
	}

	public function before ($tthis, $inthat)
	{
	    return substr($inthat, 0, strpos($inthat, $tthis));
	}

	public function before_last ($tthis, $inthat)
	{
	    return substr($inthat, 0, strrevpos($inthat, $tthis));
	}

	public function between ($tthis, $that, $inthat)
	{
	    return $this->before ($that, $this->after($tthis, $inthat));
	}

	public function between_last ($tthis, $that, $inthat)
	{
		return $this->after_last($tthis, $this->before_last($that, $inthat));
	}

}