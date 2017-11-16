<?php
Class Comprar extends Controller
{
	public function index()
	{
		$this->assign([
			'page' => [
				'title' => 'Comprar pontos',
			],
			'cash' => [
				'val' => $this->model->cash()->val,
				'min' => $this->model->cash()->min,
				'max' => $this->model->cash()->max,
			],
		]);
		$this->view('comprar');
	}

}