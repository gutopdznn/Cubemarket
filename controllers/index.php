<?php
Class Index extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->assign([
			'page' => [
				'title' => 'Início',
			],
		]);
		$this->view('index');
	}

}