<?php

namespace App\Controllers;

class Usuario extends BaseController
{
    public function index()
	{
        if (session()->has('id'))
        {
            echo "<br><br><a href='usuario/logout'>Logout</a><br><br>";
            //chama o método nivel que terá as permissões para cada tipo de usuário logado (usuario, mod e adm)
            $this->nivel();
        } else {
            echo "<a href='usuario/login'>faça login para ter acesso ilimitado ao site!</a>";
        }
        
		return view('home');
	}

	public function login()
	{
		return view('includes/head') . view('login');
	}

    public function logout()
    {
		session()->destroy();
		return redirect()->to('usuario/login');
    }

    public function verificarLogin()
    {
        //recebe dados do formulário
        $this->usuario = $this->request->getPost()['usuario'];
        $this->senha = $this->request->getPost()['senha'];
        $this->rm = $this->request->getPost()['rm'];

        //consulta sql personalizada
        $db      = \Config\Database::connect();
        $builder = $db->table('usuario');
        $builder->select('ID, Nome, Senha, Nivel, Ativo');
        $builder->where('Nome', $this->usuario);
        $builder->where('Senha', md5($this->senha));
        $builder->where('RM', $this->rm);
        $builder->where('Ativo', 1);
        $query = $builder->get()->getResultArray();

        //verifica como que está a estrutura do select
        // $sql = $builder->getCompiledSelect();

        if ($query == false) {
            return redirect()->to('usuario/login?error'); 
        } else {
            echo '<pre>';

            session()->set([
                'id' => $query[0]['ID'],
                'usuario' => $query[0]['Nome'],
                'nivel' => $query[0]['Nivel'],
                'ativo' => $query[0]['Ativo'],
            ]);
            return redirect()->to('../'); 
        }
        // print_r(session()->get());
    }

    public function consultaNivel()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('usuario');
        $builder->select('ID, Nome, Nivel, Ativo');
        // $builder->where('Nivel', session()->nivel);
        $builder->where('ID', session()->id);
        $builder->where('Ativo', session()->ativo);
        $query = $builder->get()->getResultArray();

        session()->set([
            'id' => $query[0]['ID'],
            'usuario' => $query[0]['Nome'],
            'nivel' => $query[0]['Nivel'],
            'ativo' => $query[0]['Ativo'],
        ]); 
    }

    public function nivel()
    {
        $this->consultaNivel();

        echo 'Seja bem vindo: ' . session()->usuario;

        //usuario = 1
        if (session()->nivel == 1) 
        {
        }

        //moderador = 2
        if (session()->nivel == 2) 
        {
            echo "Publicações | Usuários";
        }

        //administrador = 3
        if (session()->nivel == 3) 
        {
            echo '<a href="">Banner principal</a>'; 
            echo '<br>';
            echo '<a href="">Banner notícias</a>'; 
            echo '<br>';
            echo '<a href="">Cria categoria</a>'; 
            echo '<br>';
            echo '<a href="Views/session_adm/registro-usuarios.php" class="btn btn-primary">Usuários registrados</a>'; 
            echo '<br>';
        }
    }
}
