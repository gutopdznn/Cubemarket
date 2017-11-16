<?php
Class CheckoutModel extends Model
{
	public function __construct()
	{
		parent::__construct();
	}
	public function cash()
	{
		return $this->query('SELECT val,min,max FROM cash WHERE SID = ?', [Session::get('SID')])->first();
	}
}