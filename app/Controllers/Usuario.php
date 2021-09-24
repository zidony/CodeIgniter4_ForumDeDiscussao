<?php

namespace App\Controllers;

class Usuario extends BaseController
{
    # INDEX
    public function index()
	{
        if (session()->has('id'))
        {
            echo "<br><br><div class='container'><a href='usuario/logout'>Logout</a><br><br>";
            //chama o método nivel que terá as permissões para cada tipo de usuário logado (usuario, mod e adm)
            $this->nivel();
            echo '</div>';
        } else {
            echo "<div class='container'><a href='usuario/login'>faça login para ter acesso ilimitado ao site!</a></div>";
        }
        
		return view('includes/head') . view('home');
	}

    //============================================================================
    # INICIAR LOGIN
	public function login()
	{
		return view('includes/head') . view('login');
	}

    //============================================================================
    # LOGOUT
    public function logout()
    {
		session()->destroy();
		return redirect()->to('usuario/login');
    }

    //============================================================================
    #SESSÃO DE LOGIN
    public function recebeDadosLogin()
    {
        //recebe dados do formulário
        $this->usuario = $this->request->getPost()['usuario'];
        $this->senha = $this->request->getPost()['senha'];
        $this->rm = $this->request->getPost()['rm'];
    }

    public function verificarLogin()
    {
        $this->recebeDadosLogin();

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

    //============================================================================
    # VERIFICAÇÃO DE NÍVEL DE USUÁRIO
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
            echo '<br><br>';
            echo '<a href="">Banner principal</a>'; 
            echo '<br>';
            echo '<a href="">Banner notícias</a>'; 
            echo '<br>';
            echo '<a href="">Cria categoria</a>'; 
            echo '<br>';
            echo '<a href="administrador/listaUsuarios" class="btn btn-primary">Usuários registrados</a>'; 
            echo '<br>';
        }
    }

    //============================================================================
    #CADASTRO DE USUÁRIO
    public function registraUsuario()
    {
        return view('includes/head') . view('registre-se');
    }

    public function recebeDadosCadastro()
    {
         //recebe dados do formulário
         $this->usuario = $this->request->getPost()['usuario'];
         $this->sobrenome = $this->request->getPost()['sobrenome'];
         $this->email = $this->request->getPost()['email'];
         $this->rm = $this->request->getPost()['rm'];
         $this->dtnascimento = $this->request->getPost()['dtnascimento'];
         $this->senha = $this->request->getPost()['senha'];
    }

    public function cadastrarUsuario()
    {
        $this->recebeDadosCadastro();

        // consulta sql personalizada
        $db      = \Config\Database::connect();
        $builder = $db->table('rm');
        $builder->select('rm, nome');
        $builder->where('rm', $this->rm);
        $builder->where('Ativo', 1);
        $query = $builder->get()->getResultArray();

        if ($query == false)
        {
            # Cadastro não feito, cerifique se o RM foi digitado corretamente ou se esse RM ainda está ativo em nosso banco de dados
            return redirect()->to('usuario/registraUsuario?error'); 
        } else {
            // consulta sql personalizada
            $db      = \Config\Database::connect();
            $builder = $db->table('usuario');
            $builder->select('rm');
            $builder->where('rm', $this->rm);
            // $builder->where('Ativo', 1);
            $query = $builder->get()->getResultArray();

            if ($query == true)
            {
                return redirect()->to('usuario/registraUsuario?error2'); 
            } else {
                $db = new \App\Models\UsuarioModel();

                $this->primaryKey = 'id';

                $data = [
                    'Nome' => $this->usuario,
                    'Sobrenome' => $this->sobrenome,
                    'DataNascimento' => $this->dtnascimento,
                    'Email' => $this->email,
                    'Senha' => md5($this->senha),
                    'Foto' => '',
                    'RM' => $this->rm,
                    'Badges' => 1,
                    'Nivel' => 1,
                    'Ativo' => 1,
                ];	

                $db->save($data);
                return redirect()->to('usuario/sucesso'); 
            }
        }
    }

    //============================================================================
    #CADASTRO DE USUÁRIO - REDIRECIONAMENTO CASO A CONTA SEJA CRIADA
    public function sucesso()
    {
        return view('includes/head') . view('sucesso');
    }
}
