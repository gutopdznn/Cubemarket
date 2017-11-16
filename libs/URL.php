<?php
Class URL
{
	public static function redirect($location)
	{
		return header("Location: {$location}");
	}
	public static function getAssetsPath()
	{
		return '/assets/';
	}
	public static function getAtualUrl()
	{
		$count = strlen($_SERVER['REQUEST_URI']);
		return $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/';
	}
}