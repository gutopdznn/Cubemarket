<?php
Class Loja extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->assign(['page' => ['title' => 'Loja']]);
		
		$this->view('loja');
	}

}