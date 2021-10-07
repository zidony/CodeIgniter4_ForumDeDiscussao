<?php

namespace App\Controllers;

class Home extends BaseController
{
	# INDEX
	public function index()
	{
		return view('includes/head') . view('home');
	}

	public function consulta_categoria()
	{
		$db = new \App\Models\CategoriaModel();

		$data = $db->findAll();

		foreach ($data as $key => $value) {
			$output = '<div style="border: 1px solid black; width: 400px">
						<h2>'. $data[$key]['Titulo'] .'</h2>
						<p>'. $data[$key]['Conteudo'] .'</p>
						<p>'. $data[$key]['Imagem'] .'</p>
						<a href="'. $data[$key]['LinkAmigavel'] .'">'. $data[$key]['LinkAmigavel'] .'</a>
					</div>';

					echo $output;
		// echo '<pre>';
		// var_dump($data[$key]['Titulo']);
		}


		
	}
}
