<?php
Class Cubemarket extends Model
{
	public function __construct()
	{
		parent::__construct();
	}
	public function isExpired()
	{
		$sth = $this->query('SELECT * FROM loja WHERE url = ? OR cname = ?', [$_SERVER['SERVER_NAME'], $_SERVER['SERVER_NAME']]);
		if ($sth->count() > 0)
		{
			$now = new DateTime();
			$exp = new DateTime($sth->first()->expiry);
			if ($now > $exp)
			{
				ErrorHandler::callError('Expirou'); // Expirou
				die();
			} else {
				Session::put('SID', $sth->first()->id);
			}
		} else {
			ErrorHandler::callError('Loja não existe'); // Loja não existe
			die();
		}

	}
}