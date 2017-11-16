<?php
Class Checkout extends Controller
{
	public function index()
	{
		if (!$_POST)
		{
			URL::redirect('/comprar/');
		}
	}
}