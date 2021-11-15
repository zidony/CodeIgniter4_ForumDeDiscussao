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

	//lista de publciações na home

	//=====================================================================

    //consulta sql para trazer a lista das publicações recentes
    public function fetch_data_publicacoes($query)
	{
        $db      = \Config\Database::connect();

		$builder = $db->table('publicacao');
		$builder->select('publicacao.ID as IDPublicacao,
							usuario.Nome,
							usuario.Foto,
							conteudopublicacao.Titulo,
							conteudopublicacao.Conteudo,
							imagemPublicacao.Imagem,
							publicacao.Reacao,
							publicacao.Ativo,
							publicacao.IDUsuario,
							categoria.ID as IDCategoria,
							categoria.Ativo as CategoriaAtivo,
							categoria.linkAmigavel,
							DATE_FORMAT(publicacao.DataHora,"%d/%m/%Y") as Data,
							TIME_FORMAT(publicacao.DataHora, "%H:%i") as Hora'
							);
		$builder->join('categoria', 'categoria.ID = publicacao.IDCategoria');
		$builder->join('conteudopublicacao', 'conteudopublicacao.ID = publicacao.IDConteudo
		and conteudopublicacao.IDPublicacao = publicacao.ID');
		$builder->join('imagempublicacao', 'imagempublicacao.ID = publicacao.IDImagem
		and imagempublicacao.IDPublicacao = publicacao.ID');
		$builder->join('usuario', 'usuario.ID = publicacao.IDUsuario');
		if($query != '')
		{
			$builder->Like('conteudopublicacao.Titulo', $query);
			$builder->orLike('LinkAmigavel', $query);
			$builder->orLike('conteudopublicacao.Conteudo', $query);
			$builder->orLike('usuario.Nome', $query);
		}
		$builder->where('publicacao.Ativo', 1);
		$builder->where('categoria.Ativo', 1);
		$builder->orderBy('publicacao.ID', 'DESC');
		// $builder->orderBy('publicacao.ID', 'ASC');
		$builder->limit(4);
		return $builder->get()->getResult();
	}

    //view da tabela de categorias
	public function fetch_publicacoes()
	{
		$output = '';
		$query = '';
		$this->fetch_data_publicacoes($query);
        
		if($this->request->getPost('query'))
		{
			$query = $this->request->getPost('query');
		}
		$data = $this->fetch_data_publicacoes($query);
		if($data == true)
		{
			foreach($data as $key => $row)
			{
				$output .= 
					'<div class="row">
						<div class="col-md-12">
							<div class="box-publicacoes-home">
								<div class="box-img-publicacao-home">
									<img src="/FORUM_CODEIGNITER/assets/img/usuarios/'. $row->Foto .'">
									<br>
									<b>'. $row->Nome .'</b><br>
									<p class="data-publicacao">Publicado as: '. $row->Hora .'<br>dia '. $row->Data .'</p>
								</div> 
								<div class="box-content-publicacao-home">
									<h5 title="'. $row->Titulo .'">'. $row->Titulo .'</h5>
									<p title="'. $row->Conteudo .'">'. $row->Conteudo .'</p>
									<a href="Feed/topico/'.  $row->Titulo .'/'.  $row->IDPublicacao .'/'.  $row->IDCategoria.'" class="acessar-publicacao">Acessar publicação<br><i class="bi bi-arrow-right-square-fill icone-ir-publicacao"></i></a>
									<p class="data-publicacao">Categoria: '. $row->linkAmigavel .'</p>
								</div>
							</div>
						</div>
					</div>';
		}
		}
		else
		{
			$output .= 'Nenhum dado encontrado';
		}
		$output .= '';
		echo $output;
	}
}
