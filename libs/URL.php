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
}