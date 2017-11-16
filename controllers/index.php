<?php
Class Index extends Controller
{
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