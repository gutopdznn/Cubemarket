<?php
Class Controller
{
	public $assignedValues = [];

	public function __construct()
	{
		$this->assign([
			'assets' => URL::getAssetsPath(),
			'title' => 'CubeMarket',
		]);
	}

	public function loadModel($model)
	{
		$path = 'models/' . ucfirst($model) . 'Model.php';
		if (file_exists($path))
		{
			require $path;
			$m = $model . 'Model';
			$this->model = new $m;
		}
	}

	public function view($path)
	{
		$loader = new Twig_Loader_Filesystem('views');
		$twig = new Twig_Environment($loader);

		echo $twig->render($path . ".twig", $this->assignedValues);
	}

	public function assign($_values)
	{
		if(!empty($_values))
		{
			$this->assignedValues = array_merge($this->assignedValues, $_values);
		}
	}
}