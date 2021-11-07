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
            view('titles/title-home-curso') .
            view('includes/nav') .
            view('includes/banner-home') .
            view('curso/perguntas', $idCategoria) .
            view('includes/footer');
    }


    public function topico($titulo, $idPublicacao)
    {
        //envia para o home-curso o id da categoria
        $id['idPublicacao'] = $idPublicacao;

        return view('includes/head') .
                view('titles/title-home-curso') .
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
                'Reacao' => '',
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
        
        if ($query == true) {
            echo json_encode($query);
        } 
    }

    //=============================================================================
    public function selecionarPublicacao($idPublicacao)
    {
        // header('Content-Type: application/json');
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

    public function inserirComentario()
    {
        $myTime = Time::now('America/Sao_Paulo');
        // $myTime->toDateTimeString();

        $this->comentario = $this->request->getPost()['comentar'];
        // $this->img = $this->request->getFiles()['img'];
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

        // if($imagefile = $this->img)
        // {
        //     foreach($imagefile as $img)
        //     {
        //       if ($img->isValid() && ! $img->hasMoved()) {
        //         $Name = $img->getClientName();
        //         $img->move(WRITEPATH.'../assets/img/publicacoes/', $Name);   
        //         }   else {
        //         $Name = false;
        //         } 
        //     }
        // }
        
        //recebe dados para inserção na tabela imagem da Comentario
        $data = [
            'IDComentario' => '',
            'Imagem' => ''
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
            'Reacao' => '',
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
                            Publicacao.ID as IDPubli,
                            usuario.Nome,
                            usuario.Foto,
                            conteudoComentario.Conteudo,
                            Comentario.Reacao,
                            DATE_FORMAT(Comentario.DataHora,"%d/%m/%Y") as Data,
                            TIME_FORMAT(Comentario.DataHora, "%H:%i") as Hora'
                            );
        $builder->join('Publicacao', 'Publicacao.ID = Comentario.IDPublicacao');
        $builder->join('conteudoComentario', 'conteudoComentario.ID = Comentario.IDConteudo');
        // $builder->join('imagemComentario', 'imagemComentario.ID = Comentario.IDImagem');
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

}
