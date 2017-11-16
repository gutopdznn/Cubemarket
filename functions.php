<?php


function dd($var)
{

	var_dump($var);

	die();

}


function str_chop($str, $len = 250)
{

	if (strlen($str) < $len)
	{

		return $str;

	}

	$str = substr($str,0,$len);

	if ($spc_pos = strrpos($str," "))
	{

		$str = substr($str,0,$spc_pos);

	}

	return $str . "...";

}


function str_slug($text)
{

	$text = preg_replace('~[^\pL\d]+~u', '-', $text);

	$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

	$text = preg_replace('~-+~', '-', $text);

	$text = strtolower($text);

	$text = trim($text, '-');

	$text = preg_replace('~[^-\w]+~', '', $text);

	return (empty($text)) ? 'n-a' : $text;

}