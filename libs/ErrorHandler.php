<?php
Class ErrorHandler
{

	// TODO: Refazer classe

	public function __construct()
	{
		parent::__construct();
	}

	public static function callError($error)
	{
		die("Erro: {$error}");
	}
}