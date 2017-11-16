<?php
Class LojaModel extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function categoryExists($id)
	{
		if($this->select('cube_categories', ['ID', '=', $id])->count() > 0)
		{
			return true;
		}
		return false;
	}

	public function getCategories()
	{
		return $this->select('cube_categories')->results();
	}

	public function getCategory($id)
	{
		return $this->select('cube_categories', ['ID', '=', $id])->first();
	}

	public function getProductsByCategory($id)
	{
		return $this->select('cube_products', ['CATEGORY', '=', $id])->results();
	}
}