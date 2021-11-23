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
        $builder->select('ID, Nome, Email, Senha, Foto, Nivel, Ativo, AlertaPrivacidade');
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
                'privacidade' => $query[0]['AlertaPrivacidade'],
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

        if ($query == true) {
            session()->set([
                'id' => $query[0]['ID'],
                'usuario' => $query[0]['Nome'],
                'nivel' => $query[0]['Nivel'],
                'ativo' => $query[0]['Ativo'],
            ]);
    
            if (session()->ativo != 1) {
                session()->destroy();
            }
        } else {
            // session()->destroy();
        }

        
    }

    //============================================================================
    #PRIVACIDADE DO USUÁRIO
    public function privacidadeConfirmar()
    {
        $this->idusuario = $this->request->getPost()['idusuario'];

        //consulta sql personalizada
        $db      = \Config\Database::connect();
        $builder = $db->table('usuario');
        $builder->select('ID, AlertaPrivacidade');
        $builder->where('ID', $this->idusuario);
        $query = $builder->get()->getResultArray();

        if ($query == true) {
            
            $builder = $db->table('usuario');
            $data = [
                'AlertaPrivacidade' => 1
            ];
            $builder->where('ID',  $this->idusuario);
            $builder->update($data);

            session()->set([
                'privacidade' => 1
            ]);

            // echo json_encode($query);
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

        if ($query == true) {
            return redirect()->to('usuario/registraUsuario?UsuarioInativo=s');
            exit;
        }

        $builder = $db->table('rm');
        $builder->select('Email');
        $builder->where('Email', $this->email);
        $builder->where('Ativo', 1);
        $query = $builder->get()->getResultArray();

        if ($query == false) {
            return redirect()->to('usuario/registraUsuario?Email-Invalido=s');
            exit;
        }

        $builder = $db->table('rm');
        $builder->select('Email');
        $builder->where('Email', $this->email);
        $builder->where('Ativo', 1);
        $query = $builder->get()->getResultArray();

        if ($query == false) {
            return redirect()->to('usuario/registraUsuario?RM-Invalido=s');
            exit;
        }

        $builder = $db->table('usuario');
        $builder->select('RM');
        $builder->where('RM', $this->rm);
        $query = $builder->get()->getResultArray();

        if ($query == true) {
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
                'AlertaPrivacidade' => 0
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

    public function perfil($id)
    {
        if (session()->id == null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        } else {

            $dbUsuario = new \App\Models\UsuarioModel();

            $query = $dbUsuario->find($id);

            $data['usuario'] = $query;

            $result =  view('includes/head') .
                view('titles/title-perfil') .
                view('includes/nav') .
                view('usuario/perfil', $data) .
                view('includes/footer');
        }

        return $result;
    }

    public function alterarImagemUsuario()
    {
        $this->id = $this->request->getPost()['id'];
        $this->image = $this->request->getFiles()['image'];

        $db = new \App\Models\UsuarioModel();

        if ($imageuser = $this->image) {
            foreach ($imageuser as $img) {
                if ($img->isValid() && !$img->hasMoved()) {
                    $Name = $img->getRandomName();
                    $img->move(WRITEPATH . '../assets/img/usuarios/', $Name);
                }
            }

            $data = [
                'ID' =>  $this->id,
                'Foto' => $Name,
            ];

            $query = $db->save($data);

            //att a foto na sessão
            session()->set([
                'foto' => $Name
            ]);
        }
        return redirect()->to('Usuario/perfil/'.$this->id);
    }

    public function alterarSenhaUsuario()
    {
        $this->id = $this->request->getPost()['id'];
        $this->senha = $this->request->getPost()['senha'];
        $this->senha2 = $this->request->getPost()['senha2'];
        
        $db = new \App\Models\UsuarioModel();
      
        if ($this->senha2 === $this->senha) {

            $data = [
                'ID' =>  $this->id,
                'Senha' => md5($this->senha2),
            ];
    
            $query = $db->save($data);
        }
            
        return redirect()->to('Usuario/perfil/'.$this->id);
    }


    public function alterarDadosUsuario()
    {
        $this->id = $this->request->getPost()['id']; 
        $this->nome = $this->request->getPost()['nome']; 
        $this->sobrenome = $this->request->getPost()['sobrenome']; 
        $this->data = $this->request->getPost()['data']; 

        $db = new \App\Models\UsuarioModel();

        $data = [
            'ID' =>  $this->id,
            'Nome' => $this->nome,
            'Sobrenome' => $this->sobrenome,
            'DataNascimento' => $this->data
        ];

        $query = $db->save($data);
        
        return redirect()->to('Usuario/perfil/'.$this->id);
    }

    //==========================================================
    //PERFIL PÚBLICO

    public function perfilPublico($id)
    {
        $dbUsuario = new \App\Models\UsuarioModel();

        $query = $dbUsuario->find($id);

        $data['usuario'] = $query;

        return view('includes/head') .
                view('titles/title-perfil') .
                view('includes/nav') .
                view('usuario/perfil-publico', $data) .
                view('includes/footer');
    }
}
