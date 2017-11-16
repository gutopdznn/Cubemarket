<?php
Class Loja extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->assign([
			'page' => [
				'title' => 'Loja'
			],
			'categories' => $this->model->getCategories(),
		]);
		
		$this->view('loja');
	}

	public function categoria($id = false)
	{
		if(!$id)
		{
			URL::redirect('/loja');
		}
		if(!$this->model->categoryExists($id))
		{
			URL::redirect('/loja');
		}

		$category = $this->model->getCategory($id);

		$this->assign([
			'page' => [
				'title' => $category->NAME,
			],
			'category' => $category,
			'products' => $this->model->getProductsByCategory($id),
		]);

	}

}