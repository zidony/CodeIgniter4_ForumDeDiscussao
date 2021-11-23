<?php

namespace App\Controllers;
use App\Controllers;
use CodeIgniter\I18n\Time;
use LengthException;

class Feed extends BaseController
{
    public function publicacoes($curso, $categoria)
    {
        //envia para o home-curso o id da categoria
        $idCategoria['idCategoria'] = $categoria;

        return view('includes/head') .
            view('titles/title-publicacoes') .
            view('includes/nav') .
            view('includes/banner-home') .
            view('curso/perguntas', $idCategoria) .
            view('includes/footer');
    }


    public function topico($titulo, $idPublicacao, $idCategoria)
    {
        //envia para o home-curso o id da categoria
        $id['ids'] = [$idPublicacao, $idCategoria];

        return view('includes/head') .
                view('titles/title-publicacoes') .
                view('includes/nav') .
                view('includes/banner-home') .
                view('curso/topico' , $id) .
                view('includes/footer');
    }


    public function inserir()
    {
        $myTime = Time::now('America/Sao_Paulo');
        // $myTime->toDateTimeString();

        $this->titulo = $this->request->getPost()['titulo'];
        $this->conteudo = $this->request->getPost()['conteudo'];
        $this->img = $this->request->getFiles('img');
        $this->categoria = $this->request->getPost()['categoria'];

        $dbConteudoPublicacao = new \App\Models\ConteudoPublicacaoModel();
        $dbPublicacao = new \App\Models\PublicacaoModel();
        $dbImagemPublicacao = new \App\Models\ImagemPublicacaoModel();

        //recebe dados para inserção na tabela conteudo da publicacao
        $data = [
            'Titulo' => $this->titulo,
            'IDPublicacao' => '',
            'Conteudo' => $this->conteudo
        ];

        $query = $dbConteudoPublicacao->insert($data);
        $ultimoIDConteudo = $dbConteudoPublicacao->insertID();

        if($imagefile = $this->img)
        {
            foreach($imagefile as $img)
            {
                if ($img->isValid() && ! $img->hasMoved()) {
                    $Name = $img->getRandomName();
                    $img->move(WRITEPATH.'../assets/img/publicacoes/', $Name);   
                }  else {
                    $Name = false;
                } 
            }
        }
        
        //recebe dados para inserção na tabela imagem da publicacao
        $data = [
            'IDPublicacao' => '',
            'Imagem' => $Name,
        ];

        $query = $dbImagemPublicacao->insert($data);
        $ultimoIDImagem = $dbImagemPublicacao->insertID();

        if ($query == true)
        {
            //dados para inserção na tabela publicação
            $data = [
                'IDConteudo' => $ultimoIDConteudo,
                'IDCategoria' => $this->categoria,
                'DataHora' => $myTime->toDateTimeString(),
                'IDImagem' => $ultimoIDImagem,
                'IDUsuario' => session()->id,
                'Ativo' => 1
            ];

            //insert
            $query = $dbPublicacao->insert($data);
            $ultimoIDPublicacao = $dbPublicacao->insertID();

            if ($query == true)
            {
                //recebe dados para inserção na tabela conteudo da publicacao
                $data = [
                    'ID' => $ultimoIDConteudo,
                    'IDPublicacao' => $ultimoIDPublicacao,
                ];
    
                $query = $dbConteudoPublicacao->save($data);
    
                //recebe dados para inserção na tabela conteudo da publicacao
                $data = [
                    'ID' => $ultimoIDImagem,
                    'IDPublicacao' => $ultimoIDPublicacao,
                ];
    
                $query = $dbImagemPublicacao->save($data);
            }
    
            // para alertar se a publi foi ou n salvo
            if ($query == true) {
                echo json_encode($query);
            }
        }  
    }

    public function selecionar($idCategoria)
    {
        // header('Content-Type: application/json');
        $db      = \Config\Database::connect();

        $builder = $db->table('categoria');
        $builder->select('*');
        $builder->where('ID', $idCategoria);
        $builder->where('Ativo', 1);
        $query = $builder->get()->getResult();

        if ($query == false) {
            $query == false;
        } else {
            $builder = $db->table('publicacao');
            $builder->select('publicacao.ID as IDPublicacao,
                                usuario.Nome,
                                usuario.Foto,
                                conteudopublicacao.Titulo,
                                conteudopublicacao.Conteudo,
                                imagemPublicacao.Imagem,
                                publicacao.Ativo,
                                publicacao.IDUsuario,
                                categoria.ID as IDCategoria,
                                DATE_FORMAT(publicacao.DataHora,"%d/%m/%Y") as Data,
                                TIME_FORMAT(publicacao.DataHora, "%H:%i") as Hora'
                                );
            $builder->join('categoria', 'categoria.ID = publicacao.IDCategoria');
            $builder->join('conteudopublicacao', 'conteudopublicacao.ID = publicacao.IDConteudo
            and conteudopublicacao.IDPublicacao = publicacao.ID');
            $builder->join('imagempublicacao', 'imagempublicacao.ID = publicacao.IDImagem
            and imagempublicacao.IDPublicacao = publicacao.ID');
            $builder->join('usuario', 'usuario.ID = publicacao.IDUsuario');
            $builder->where('categoria.ID', $idCategoria);
            $builder->where('publicacao.Ativo', 1);
            $builder->orderBy('publicacao.ID');
            $query = $builder->get()->getResult();
        }

        if ($query == true) {
            echo json_encode($query);
        } else {
            echo json_encode($query);
        }

        
    }

    //=============================================================================
    public function selecionarPublicacao($idPublicacao, $idCategoria)
    {
        // header('Content-Type: application/json');
        $db      = \Config\Database::connect();

        $builder = $db->table('categoria');
        $builder->select('*');
        $builder->where('ID', $idCategoria);
        $builder->where('Ativo', 1);
        $query = $builder->get()->getResult();

        if ($query == false) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(); 
        } else {
            $builder = $db->table('publicacao');
            $builder->select('publicacao.ID as IDPublicacao,
                                usuario.Nome,
                                usuario.Foto,
                                conteudopublicacao.Titulo,
                                conteudopublicacao.Conteudo,
                                imagemPublicacao.Imagem,
                                publicacao.Ativo,
                                publicacao.IDUsuario,
                                DATE_FORMAT(publicacao.DataHora,"%d/%m/%Y") as Data,
                                TIME_FORMAT(publicacao.DataHora, "%H:%i") as Hora'
                                );
            $builder->join('categoria', 'categoria.ID = publicacao.IDCategoria');
            $builder->join('conteudopublicacao', 'conteudopublicacao.ID = publicacao.IDConteudo
            and conteudopublicacao.IDPublicacao = publicacao.ID');
            $builder->join('imagempublicacao', 'imagempublicacao.ID = publicacao.IDImagem
            and imagempublicacao.IDPublicacao = publicacao.ID');
            $builder->join('usuario', 'usuario.ID = publicacao.IDUsuario');
            $builder->where('publicacao.ID', $idPublicacao);
            $builder->where('publicacao.Ativo', 1);
            $builder->orderBy('publicacao.ID');
            $query = $builder->get()->getResult();
            
            if ($query == true) {
                echo json_encode($query);
            }
        }
    }

    public function inserirComentario()
    {
        $myTime = Time::now('America/Sao_Paulo');
        // $myTime->toDateTimeString();

        $this->comentario = $this->request->getPost()['comentar'];
        $this->img = $this->request->getFiles()['img'];
        $this->idpublicacao = $this->request->getPost()['idpublicacao'];

        $dbConteudoComentario = new \App\Models\ConteudoComentarioModel();
        $dbComentario = new \App\Models\ComentarioModel();
        $dbImagemComentario = new \App\Models\ImagemComentarioModel();

        //recebe dados para inserção na tabela conteudo da Comentario
        $data = [
            'IDComentario' => '',
            'Conteudo' => $this->comentario
        ];

        $query = $dbConteudoComentario->insert($data);
        $ultimoIDConteudo = $dbConteudoComentario->insertID();

        if($imagefile = $this->img)
        {
            foreach($imagefile as $img)
            {
                if ($img->isValid() && ! $img->hasMoved()) {
                        $Name = $img->getRandomName();
                        $img->move(WRITEPATH.'../assets/img/publicacoes/', $Name);   
                }  else {
                    $Name = false;
                } 
            }
        }
        
        //recebe dados para inserção na tabela imagem da Comentario
        $data = [
            'IDComentario' => '',
            'Imagem' => $Name
        ];

        $query = $dbImagemComentario->insert($data);
        $ultimoIDImagem = $dbImagemComentario->insertID();

        //dados para inserção na tabela Comentario
        $data = [
            'IDPublicacao' => $this->idpublicacao ,
            'IDUsuario' => session()->id,
            'IDConteudo' => $ultimoIDConteudo,
            'IDImagem' => $ultimoIDImagem,
            'DataHora' => $myTime->toDateTimeString(),
            'Ativo' => 1
        ];

        //insert
        $query = $dbComentario->insert($data);
        $ultimoIDComentario = $dbComentario->insertID();

        if ($query == true)
        {
            //recebe dados para inserção na tabela conteudo da Comentario
            $data = [
                'ID' => $ultimoIDConteudo,
                'IDComentario' => $ultimoIDComentario,
            ];

            $query = $dbConteudoComentario->save($data);

            //recebe dados para inserção na tabela conteudo da Comentario
            $data = [
                'ID' => $ultimoIDImagem,
                'IDComentario' => $ultimoIDComentario,
            ];

            $query = $dbImagemComentario->save($data);
        }

        // para alertar se o Comentario foi ou n salvo
        if ($query == true) {
            echo json_encode('Comentário Salvo com Sucesso');
        } else {
            echo json_encode('Falha ao salvar comentário');
        }

    }

    public function selecionarComentarios($idPublicacao)
    {
        // header('Content-Type: application/json');
        $db      = \Config\Database::connect();
        $builder = $db->table('comentario');
        $builder->select('Comentario.ID IDCOMENTARIO,
                            Publicacao.ID as IDPublicacao,
                            usuario.ID as IDUsuario,
                            usuario.Nome,
                            usuario.Foto,
                            conteudoComentario.Conteudo,
                            imagemComentario.Imagem,
                            DATE_FORMAT(Comentario.DataHora,"%d/%m/%Y") as Data,
                            TIME_FORMAT(Comentario.DataHora, "%H:%i") as Hora'
                            );
        $builder->join('Publicacao', 'Publicacao.ID = Comentario.IDPublicacao');
        $builder->join('conteudoComentario', 'conteudoComentario.ID = Comentario.IDConteudo');
        $builder->join('imagemComentario', 'imagemComentario.ID = Comentario.IDImagem');
        $builder->join('usuario', 'usuario.ID = Comentario.IDUsuario');
        $builder->where('Comentario.Ativo', 1);
        $builder->where('Comentario.IDPublicacao', $idPublicacao);
        $builder->orderBy('Comentario.ID');
        $query = $builder->get()->getResult();
        
        if ($query == true) {
            echo json_encode($query);
        } 
        // else {
        //     echo json_encode('Nenhum comentário encontrado');
        // }
    }

    //=============================================================================
    // ações na publicação

    public function editarPublicacaoSelecionada($idPublicacao)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('publicacao');
        $builder->select('publicacao.ID as IDPublicacao,
                            conteudopublicacao.ID as IDConteudo,
                            imagemPublicacao.ID as IDImagem,
                            usuario.Nome,
                            usuario.Foto,
                            conteudopublicacao.Titulo,
                            conteudopublicacao.Conteudo,
                            imagemPublicacao.Imagem,
                            publicacao.Ativo,
                            publicacao.IDUsuario,
                            DATE_FORMAT(publicacao.DataHora,"%d/%m/%Y") as Data,
                            TIME_FORMAT(publicacao.DataHora, "%H:%i") as Hora'
                            );
        $builder->join('categoria', 'categoria.ID = publicacao.IDCategoria');
        $builder->join('conteudopublicacao', 'conteudopublicacao.ID = publicacao.IDConteudo
        and conteudopublicacao.IDPublicacao = publicacao.ID');
        $builder->join('imagempublicacao', 'imagempublicacao.ID = publicacao.IDImagem
        and imagempublicacao.IDPublicacao = publicacao.ID');
        $builder->join('usuario', 'usuario.ID = publicacao.IDUsuario');
        $builder->where('publicacao.ID', $idPublicacao);
        $builder->where('publicacao.Ativo', 1);
        $query = $builder->get()->getResult();

        if ($query == true) {
            echo json_encode($query);
        }
    }

    

    public function editarPublicacao()
    {
        $this->idpublicacao = $this->request->getPost()['idpublicacao'];
        $this->idconteudo = $this->request->getPost()['idconteudo'];
        $this->titulo = $this->request->getPost()['titulo'];
        $this->conteudo = $this->request->getPost()['conteudo'];

        $dbConteudoPublicacao = new \App\Models\ConteudoPublicacaoModel();

        //recebe dados para inserção na tabela conteudo da publicacao
        $data = [
            'ID' => $this->idconteudo,
            'Titulo' => $this->titulo,
            'IDPublicacao' => $this->idpublicacao,
            'Conteudo' => $this->conteudo
        ];

        $query = $dbConteudoPublicacao->save($data);  

        return redirect()->back();
        
    }

    public function editarImagemPublicacaoSelecionada($idPublicacao)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('publicacao');
        $builder->select('publicacao.ID as IDPublicacao,
                            imagempublicacao.ID as IDImagem,
                            usuario.Nome,
                            usuario.Foto,
                            imagempublicacao.Imagem,
                            imagemPublicacao.Imagem,
                            publicacao.Ativo,
                            publicacao.IDUsuario,
                            DATE_FORMAT(publicacao.DataHora,"%d/%m/%Y") as Data,
                            TIME_FORMAT(publicacao.DataHora, "%H:%i") as Hora'
                            );
        $builder->join('categoria', 'categoria.ID = publicacao.IDCategoria');
        $builder->join('conteudopublicacao', 'conteudopublicacao.ID = publicacao.IDConteudo
        and conteudopublicacao.IDPublicacao = publicacao.ID');
        $builder->join('imagempublicacao', 'imagempublicacao.ID = publicacao.IDImagem
        and imagempublicacao.IDPublicacao = publicacao.ID');
        $builder->join('usuario', 'usuario.ID = publicacao.IDUsuario');
        $builder->where('publicacao.ID', $idPublicacao);
        $builder->where('publicacao.Ativo', 1);
        $query = $builder->get()->getResult();

        if ($query == true) {
            echo json_encode($query);
        }
    }

    public function editarImagemPublicacao()
    {
        $this->idpublicacao = $this->request->getPost()['idpublicacao'];
        $this->idimagem = $this->request->getPost()['idimagem'];
        $this->img = $this->request->getFiles()['img'];

        $dbImagemPublicacao = new \App\Models\ImagemPublicacaoModel();

        if($imagefile = $this->img)
        {
            foreach($imagefile as $img)
            {
                if ($img->isValid() && ! $img->hasMoved()) {
                    $Name = $img->getRandomName();
                    $img->move(WRITEPATH.'../assets/img/publicacoes/', $Name);   
                }  else {
                    $Name = false;
                } 
            }
        }
        
        //recebe dados para inserção na tabela imagem da publicacao
        $data = [
            'ID' => $this->idimagem,
            'IDPublicacao' => $this->idpublicacao,
            'Imagem' => $Name,
        ];

        $query = $dbImagemPublicacao->save($data);

        return redirect()->back(); 
    }

    public function excluirPublicacaoSelecionada($idpublicacao)
    {
        $dbPublicacao = new \App\Models\PublicacaoModel();

        $data = [
            'ID' => $idpublicacao,
            'Ativo' => 0
        ];

        $query = $dbPublicacao->save($data);

        return redirect()->back();
    }

    //para comentarios
    public function editarComentarioSelecionada($idComentario)
    {
        // header('Content-Type: application/json');
        $db      = \Config\Database::connect();
        $builder = $db->table('comentario');
        $builder->select('Comentario.ID,
                            conteudocomentario.ID as IDConteudoComentario,
                            conteudoComentario.Conteudo,
                            imagemComentario.ID as IDImagem,
                            imagemComentario.Imagem'
                            );
        $builder->join('conteudoComentario', 'conteudoComentario.ID = Comentario.IDConteudo');
        $builder->join('imagemComentario', 'imagemComentario.ID = Comentario.IDImagem');
        $builder->where('Comentario.Ativo', 1);
        $builder->where('Comentario.ID', $idComentario);
        $builder->orderBy('Comentario.ID');
        $query = $builder->get()->getResult();

        $data['comentario'] = $query;

        // echo '<pre>';
        // var_dump($builder->getCompiledSelect());
        // var_dump($builder->get()->getResult());

        if ($query == true) {
            echo json_encode($query);
        }
    }


    public function editarComentario()
    {
        $this->idcomentario = $this->request->getPost()['idconteudo'];
        $this->conteudo = $this->request->getPost()['conteudo'];

        $dbComentario = new \App\Models\ConteudoComentarioModel();

        //recebe dados para inserção na tabela conteudo da publicacao
        $data = [
            'ID' => $this->idcomentario,
            'Conteudo' => $this->conteudo
        ];

        $query = $dbComentario->save($data);       

        return redirect()->back();
        
    }

    public function editarImagemComentario()
    {
        $this->idimagem = $this->request->getPost()['idimagem'];
        $this->img = $this->request->getFiles()['img'];

        $dbImagemComentario = new \App\Models\ImagemComentarioModel();

        if($imagefile = $this->img)
        {
            foreach($imagefile as $img)
            {
                if ($img->isValid() && ! $img->hasMoved()) {
                    $Name = $img->getRandomName();
                    $img->move(WRITEPATH.'../assets/img/publicacoes/', $Name);   
                }  else {
                    $Name = false;
                } 
            }
        }
        
        //recebe dados para inserção na tabela imagem da publicacao
        $data = [
            'ID' => $this->idimagem,
            'Imagem' => $Name,
        ];

        $query = $dbImagemComentario->save($data);
        

        return redirect()->back();
        
    }

    public function excluirComentarioSelecionado($idcomentario)
    {
        $dbPublicacao = new \App\Models\ComentarioModel();

        $data = [
            'ID' => $idcomentario,
            'Ativo' => 0
        ];

        $query = $dbPublicacao->save($data);

        return redirect()->back();
    }

    //=====================================================================
    
    public function fetch_data_comentarios($query)
	{
        $db      = \Config\Database::connect();

		$builder = $db->table('publicacao');
		$builder->select('publicacao.ID as IDPublicacao,
							usuario.Nome,
							usuario.Foto,
							conteudopublicacao.Titulo,
							conteudopublicacao.Conteudo,
							imagemPublicacao.Imagem,
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
		$builder->limit(10);
		return $builder->get()->getResult();
	}

    //view da tabela de categorias
	public function fetch_comentarios()
	{
		$output = '';
		$query = '';
		$this->fetch_data_comentarios($query);
        
		if($this->request->getPost('query'))
		{
			$query = $this->request->getPost('query');
		}
		$data = $this->fetch_data_comentarios($query);
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
									<a href="/FORUM_CODEIGNITER/public/Feed/topico/'.  $row->Titulo .'/'.  $row->IDPublicacao .'/'.  $row->IDCategoria.'" class="acessar-publicacao">Acessar<br><i class="bi bi-arrow-right-square-fill icone-ir-publicacao"></i></a>
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
