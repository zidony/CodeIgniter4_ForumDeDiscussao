<?php

namespace App\Controllers;

class Usuario extends BaseController
{
    //============================================================================
    # INICIAR LOGIN
	public function login()
	{
		return view('includes/head') .
                view('login/login') .
                view('includes/footer');
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
        $builder->select('ID, Nome, Email, Senha, Foto, Nivel, Ativo');
        $builder->where('Email', $this->usuario);
        $builder->where('Senha', md5($this->senha));
        $builder->where('RM', $this->rm);
        $builder->where('Ativo', 1);
        $query = $builder->get()->getResultArray();

        //verifica como que está a estrutura do select
        // var_dump($builder->getCompiledSelect());

        if ($query == false) {
            return redirect()->to('usuario/login?error'); 
        } else {
            // echo '<pre>';

            session()->set([
                'id' => $query[0]['ID'],
                'usuario' => $query[0]['Nome'],
                'email' => $query[0]['Email'],
                'foto' => $query[0]['Foto'],
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
        $builder->where('ID', session()->id);
        $query = $builder->get()->getResultArray();

        session()->set([
            'id' => $query[0]['ID'],
            'usuario' => $query[0]['Nome'],
            'nivel' => $query[0]['Nivel'],
            'ativo' => $query[0]['Ativo'],
        ]);

        if (session()->ativo != 1)
        {
            session()->destroy();
        }
    }

    //============================================================================
    #CADASTRO DE USUÁRIO
    public function registraUsuario()
    {
        return view('includes/head') .
                view('login/registre-se') .
                view('includes/footer');
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

    public function cadastroUsuario()
    {
        $this->recebeDadosCadastro();

        $db      = \Config\Database::connect();
        $builder = $db->table('rm');
        $builder->select('RM');
        $builder->where('Ativo', 0);
        $query = $builder->get()->getResultArray();

        if ($query == true) 
        {
            return redirect()->to('usuario/registraUsuario?UsuarioInativo=s');
            exit;
        }

        $builder = $db->table('rm');
        $builder->select('Email');
        $builder->where('Email', $this->email);
        $builder->where('Ativo', 1);
        $query = $builder->get()->getResultArray();

        if ($query == false)
        {
            return redirect()->to('usuario/registraUsuario?Email-Invalido=s');
            exit; 
        } 

        $builder = $db->table('rm');
        $builder->select('Email');
        $builder->where('Email', $this->email);
        $builder->where('Ativo', 1);
        $query = $builder->get()->getResultArray();

        if ($query == false)
        {
            return redirect()->to('usuario/registraUsuario?RM-Invalido=s');
            exit;
        }

        $builder = $db->table('usuario');
        $builder->select('RM');
        $builder->where('RM', $this->rm);
        $query = $builder->get()->getResultArray();

        if ($query == true)
        {
            return redirect()->to('usuario/registraUsuario?RM-JaRegistrado=s'); 
            exit;
        } else {
            $db = new \App\Models\UsuarioModel();

            $this->primaryKey = 'id';

            $data = [
                'Nome' => $this->usuario,
                'Sobrenome' => $this->sobrenome,
                'DataNascimento' => $this->dtnascimento,
                'Email' => $this->email,
                'Senha' => md5($this->senha),
                'Foto' => 'user.png',
                'RM' => $this->rm,
                'Nivel' => 1,
                'Ativo' => 1,
            ];	

            $db->save($data);
            return view('includes/head') .
                    view('login/sucesso') .
                    view('includes/footer'); 
        }
    }

    //============================================================================
    
    public function esqueceuSenha()
    {
        return view('includes/head') .
                view('titles/title-esqueceu-senha') .
                view('includes/nav') .
                view('login/esqueceu-senha') .
                view('includes/footer');
    }

    //============================================================================
    //perfil de usuário

    public function perfil($id = null)
    {
        if (session()->id == null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        } else {
            return  view('includes/head') .
            view('titles/title-perfil') .
            view('includes/nav') .
            view('usuario/perfil') .
            view('includes/footer');
        }
        
    }


    public function viewuserimage()
    {
        return view('testefotouser');
    }

    public function GetImageUser()
    {
        $this->userimage = $this->request->getFiles()['userimage'];
    }

    public function UserImage()
    {
        $this->GetImageUser();
        $this->idusuario = session()->id;
       
        if ($imageuser = $this->userimage) {
            foreach ($imageuser as $img) {
                if ($img->isValid() && !$img->hasMoved()) {
                    $Name = $img->getRandomName();
                    $img->move(WRITEPATH . '../assets/img/usuarios/', $Name);

                    $data = [
                        'Foto' => $Name,
                    ];

                    $db  = \Config\Database::connect();
                    $builder = $db->table('usuario');
                    $builder->where('id', $this->idusuario);
                    $builder->update($data);
                }
            }
        }  
    }
}
