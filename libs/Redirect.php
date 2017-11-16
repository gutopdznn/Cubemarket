<?php
Class Redirect
{
	public static function to($location = false;)
	{
		if($location)
		{
			return header("Location: " . $location);
		}
	}
}