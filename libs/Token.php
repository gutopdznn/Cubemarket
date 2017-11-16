<?php
Class Token
{

	// Cross Site Request Forgety Protection Token 

	public static function generate($formName)
	{
		return Session::put($formName, md5(uniqid()));
	}

	public static function check($formName, $token)
	{
		if(Session::exists($formName) && $token === Session::get($formName))
		{
			Session::delete($formName);
			return true;
		}
		return false;
	}
}