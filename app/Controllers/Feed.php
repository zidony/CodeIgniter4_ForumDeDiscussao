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
        $this->img = $this->request->getPost()['img'];
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

        //instancia usada para mover imagem
        $file = new \CodeIgniter\Files\File($this->img);

        $imagemPublicacao = $file->getBasename($this->img);
        // $file= $file->move(WRITEPATH.'../assets/img/', $imagemPublicacao);

        //recebe dados para inserção na tabela imagem da publicacao
        $data = [
            'IDPublicacao' => '',
            'Imagem' => $imagemPublicacao,
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
            echo json_encode('Comentário Salvo com Sucesso');
        } else {
            echo json_encode('Falha ao salvar comentário');
        }
    }

    public function selecionar()
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
        $query = $builder->where('publicacao.Ativo', 1);
        $query = $builder->get()->getResult();
        
        if ($query == true) {
            echo json_encode($query);
        } 
        // else {
        //     echo json_encode('Nenhum comentário encontrado');
        // }
    }

    //teste query
    // public function query()
    // {
    //     $db      = \Config\Database::connect();
    //     $builder = $db->table('publicacao');
    //     $builder->select('publicacao.ID,
    //                         usuario.Nome,
    //                         usuario.Foto,
    //                         conteudopublicacao.Titulo,
    //                         conteudopublicacao.Conteudo,
    //                         imagemPublicacao.Imagem,
    //                         publicacao.Reacao,
    //                         publicacao.Ativo,
    //                         publicacao.IDUsuario,
    //                         DATE_FORMAT(publicacao.DataHora,"%d/%m/%Y")'
    //                         );
    //     // TIME_FORMAT(publicacao.DataHora, "%H:%i:%s") as DataHora
    //     $builder->join('categoria', 'categoria.ID = publicacao.IDCategoria');
    //     $builder->join('conteudopublicacao', 'conteudopublicacao.ID = publicacao.IDConteudo
    //     and conteudopublicacao.IDPublicacao = publicacao.ID');
    //     $builder->join('imagempublicacao', 'imagempublicacao.ID = publicacao.IDImagem
    //     and imagempublicacao.IDPublicacao = publicacao.ID');
    //     $builder->join('usuario', 'usuario.ID = publicacao.IDUsuario');
    //     $query = $builder->where('publicacao.Ativo', 1);
    //     var_dump($builder->getCompiledSelect());
    // }

    //teste front publi
    public function x()
    {
        return view('includes/head'). view('card') . view('includes/footer');
    }

}
