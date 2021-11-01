<?php

namespace App\Controllers;
use App\Controllers;
use CodeIgniter\I18n\Time;

class Feed extends BaseController
{
    public function publicacoes($curso, $categoria)
    {
        // $this->curso = $this->request->getGet('curso');
        // $this->categoria = $this->request->getGet('codigo');

        if (!session()->has('id'))
        {
            echo 'faça login para acessar o feed ilimitado';
        }
        else {
            var_dump('id usuário logado = ' . session()->id);
        }

        //envia para o home-curso o id da categoria
        $idCategoria['idCategoria'] = $categoria;

        return view('includes/head') .
            view('titles/title-home-curso') .
            view('includes/nav') .
            // view('includes/banner-home') .
            view('curso/home-curso' , $idCategoria) .
            view('includes/footer');
    }

    public function inserir()
    {
        $myTime = Time::now('America/Sao_Paulo');
        // $myTime->toDateTimeString();

        $this->titulo = $this->request->getPost()['name'];
        $this->conteudo = $this->request->getPost()['comment'];
        $this->img = $this->request->getPost('img');
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


        $file = new \CodeIgniter\Files\File($this->img);
        $name = $file->getBasename();
        
        //recebe dados para inserção na tabela imagem da publicacao
        $data = [
            'IDPublicacao' => '',
            'Imagem' => $name,
        ];

        $query = $dbImagemPublicacao->insert($data);
        $ultimoIDImagem = $dbImagemPublicacao->insertID();

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
            echo json_encode('Publicação Salvo com Sucesso');
        } else {
            echo json_encode('Falha ao salvar Publicação');
        }
    }

    public function selecionar($idCategoria)
    {
        // header('Content-Type: application/json');
        $db      = \Config\Database::connect();
        $builder = $db->table('publicacao');
        $builder->select('publicacao.ID,
                            usuario.Nome,
                            usuario.Foto,
                            conteudopublicacao.Titulo,
                            conteudopublicacao.Conteudo,
                            imagemPublicacao.Imagem,
                            publicacao.Reacao,
                            publicacao.Ativo,
                            publicacao.IDUsuario,
                            DATE_FORMAT(publicacao.DataHora,"%d/%m/%Y") as Data,
                            TIME_FORMAT(publicacao.DataHora, "%H:%i:%s") as Hora'
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
        // else {
        //     echo json_encode('Nenhum comentário encontrado');
        // }
    }

    //teste front publi
    public function x()
    {
        return view('includes/head'). view('card') . view('includes/footer');
    }

    //=============================================================================
    public function comentario()
    {
        $myTime = Time::now('America/Sao_Paulo');
        // $myTime->toDateTimeString();

        $this->comentario = $this->request->getPost()['comentario'];
        $this->img = $this->request->getPost('img');
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


        $file = new \CodeIgniter\Files\File($this->img);
        $name = $file->getBasename();
        
        //recebe dados para inserção na tabela imagem da Comentario
        $data = [
            'IDComentario' => '',
            'Imagem' => $name,
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

    public function selecionarComentario()
    {
        // header('Content-Type: application/json');
        $db      = \Config\Database::connect();
        $builder = $db->table('comentario');
        $builder->select('Comentario.ID,
                            Publicacao.ID as IDPubli,
                            usuario.Nome,
                            usuario.Foto,
                            conteudoComentario.Conteudo,
                            imagemComentario.Imagem,
                            Comentario.Reacao,
                            DATE_FORMAT(Comentario.DataHora,"%d/%m/%Y") as Data,
                            TIME_FORMAT(Comentario.DataHora, "%H:%i:%s") as Hora'
                            );
        $builder->join('Publicacao', 'Publicacao.ID = Comentario.IDPublicacao');
        $builder->join('conteudoComentario', 'conteudoComentario.ID = Comentario.IDConteudo');
        $builder->join('imagemComentario', 'imagemComentario.ID = Comentario.IDImagem');
        $builder->join('usuario', 'usuario.ID = Comentario.IDUsuario');
        $builder->where('Comentario.Ativo', 1);
        // $builder->where('Comentario.IDPublicacao', $idpublicacao);
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
