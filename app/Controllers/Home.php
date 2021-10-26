<?php

namespace App\Controllers;

class Home extends BaseController
{
	# INDEX
	public function index()
	{
		return 
			view('includes/head') .
			view('titles/title-index') .
			view('includes/nav') .
			view('includes/banner-home') . 
			view('home') . 
			view('includes/duvidas') .
			view('includes/footer');
	}

	public function consulta_categoria()
	{
		$db = new \App\Models\CategoriaModel();
		$data = $db->findAll();

		return $data;
	}
}
