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
        $teste['teste'] = $categoria;

        return view('includes/head') .
            view('titles/title-home-curso') .
            view('includes/nav') .
            // view('includes/banner-home') .
            view('curso/home-curso' , $teste) .
            view('includes/footer');
    }

    public function inserir()
    {
        $myTime = Time::now('America/Sao_Paulo');
        // $myTime->toDateTimeString();

        $this->titulo = $this->request->getPost()['name'];
        $this->conteudo = $this->request->getPost()['comment'];
        $this->categoria = $this->request->getPost()['categoria'];

        $dbConteudoPublicacao = new \App\Models\ConteudoPublicacaoModel();
        $dbPublicacao = new \App\Models\PublicacaoModel();
        $db = new \App\Models\ImagemPublicacaoModel();

        //dados para inserção na tabela publicação
        $data = [
            'IDConteudo' => '',
            'IDCategoria' => $this->categoria,
            'DataHora' => $myTime->toDateTimeString(),
            'IDImagem' => '',
            'IDUsuario' => session()->id,
            'Reacao' => '',
            'Ativo' => 1
        ];

        //insert
        $query = $dbPublicacao->insert($data);

        //verificar a inserção, caso verdadeira
        if ($query == true) 
        {
            $data = [
                'Titulo' => $this->titulo,
                'IDPublicacao' => $dbPublicacao->insertID(),
                'Conteudo' => $this->conteudo
            ];

            $query = $dbConteudoPublicacao->insert($data);

            //FALTA INSERIR O ID CONTEUDO NA TABELA PUBLIC

            // para alertar se a publi foi ou n salvo
            if ($query == true) {
                echo json_encode('Comentário Salvo com Sucesso');
            } else {
                echo json_encode('Falha ao salvar comentário');
            }

        } else {
            
        }   
    }

    public function selecionar()
    {
        // header('Content-Type: application/json');
        $db      = \Config\Database::connect();
        $builder = $db->table('conteudopublicacao');
        $builder->select('*');
        $query = $builder->limit(20);
        // $query = $builder->get()->getResult();

        
        if ($query == true) {
            echo json_encode($query = $builder->get()->getResult());
        } else {
            echo json_encode('Nenhum comentário encontrado');
        }
    }

}
