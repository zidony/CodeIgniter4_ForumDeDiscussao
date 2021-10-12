<?php

namespace App\Controllers;

class Administrador extends BaseController
{
    //a index é definida comoa a tabela de usuários
    public function index()
	{
		return view('includes/head') . view('administrador/usuarios');
	}

    //consulta sql para pegar a lista de usuários
    public function fetch_data($query)
	{
        $db      = \Config\Database::connect();
        $builder = $db->table('usuario');
        $builder->select('*');
        if($query != '')
        {
            $builder->Like('Nome', $query);
            $builder->orLike('Email', $query);
            $builder->orLike('RM', $query);
        }
        $builder->orderBy('ID', 'DESC');
        return $builder->get()->getResult();
        // echo '<pre>';
        // var_dump($builder->get()->getResult());
	}

    // view da tabela e seus dados (usuário)
	public function fetch()
	{
		$output = '';
		$query = '';
		$this->fetch_data($query);
        
		if($this->request->getPost('query'))
		{
			$query = $this->request->getPost('query');
		}
		$data = $this->fetch_data($query);
		$output .= '
		<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<tr>
							<th>Nome</th>
                            <th>Sobrenome</th>
							<th>Email</th>
							<th>RM</th>
                            <th>Nível</th>
                            <th>Ativo</th>
                            <th>Gerar senha</th>
						</tr>
		';
		if($data == true)
		{
			foreach($data as $key => $row)
			{
                $row->GerarSenha = '<a href="senha/' . $row->ID . '">Gerar senha</a>';
                //nivel de usuário (nome amigável)
                if ($row->Nivel == 1) {
                    $row->Nivel = 'Usuário';
                }
                else if ($row->Nivel == 2) {
                    $row->Nivel = 'Moderador';
                }
                else if ($row->Nivel == 3) {
                    $row->Nivel = 'Administrador';
                }
                //altera para nome amigavel
                if ($row->Ativo == 1) {
                    $row->Ativo = '<a href="ativaDesativaUsuario/' . $row->ID . '/ ' . $row->Ativo . '">Desativar usuário</a>';
                } 
                else if ($row->Ativo == 0) {
                    $row->Ativo = '<a href="ativaDesativaUsuario/' . $row->ID . '/ ' . $row->Ativo . '">Ativar usuário</a>';
                }

				$output .= '
						<tr>
							<td>'.$row->Nome.'</td>
                            <td>'.$row->Sobrenome.'</td>
							<td>'.$row->Email.'</td>
							<td>'.$row->RM.'</td>
                            <td>'.$row->Nivel.'</td>
                            <td>'.$row->Ativo.'</td>
                            <td>'.$row->GerarSenha.'</td>
						</tr>
				';
			}
		}
		else
		{
			$output .= '<tr>
							<td colspan="5">Nenhum dado encontrado</td>
						</tr>';
		}
		$output .= '</table>';
		echo $output;
	}

    //desativa e ativa o usuário
    public function ativaDesativaUsuario($id = null, $ativo = null)
    {
        $db = new \App\Models\UsuarioModel();

        $this->primaryKey = 'id';

        if ($ativo == 1) {
            $data = [
                'ID' => $id,
                'Ativo' => 0
            ];	
        } else {
            $data = [
                'ID' => $id,
                'Ativo' => 1
            ];	
        }

        $db->save($data);
        return redirect()->to('Administrador/index'); 
    }

    //leva para tela gerção de senha do usuário
    public function senha($id = null)
    {
        $db = new \App\Models\UsuarioModel();
        if ($id == null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        } else {
            $query = $db->find($id);

            $data['usuario'] = $query;

            return view('administrador/gerar-senha', $data);
        }
    }

    //gera a senha para o usuário
    public function senhaGerada()
    {
        $db = new \App\Models\UsuarioModel();

        $this->id = $this->request->getPost()['ID'];
        $this->rm = $this->request->getPost()['rm'];
        $this->senha = $this->request->getPost()['senha'];

        $this->primaryKey = 'id';
    
        $data = [
            'ID' => $this->id, 
            'Senha' => md5($this->senha),
            'RM' => $this->rm,
        ];

        $result = $db->save($data);
        if ($result == true)
        {
            return redirect()->to('Administrador/index'); 
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        
    }

    //================================================================================================
    //========================================CATEGORIAS==============================================

    //leva para a tela de categorias para cadastro
    public function categoria()
    {
        return  view('includes/head') . view('administrador/categoria');
    }

    //consulta sql para trazer a lista das categorias
    public function fetch_data_categoria($query)
	{
        $db      = \Config\Database::connect();
        $builder = $db->table('categoria');
        $builder->select('*');
        if($query != '')
        {
            $builder->Like('Titulo', $query);
            $builder->orLike('LinkAmigavel', $query);
        }
        $builder->orderBy('ID', 'DESC');
        return $builder->get()->getResult();
	}

    //view da tabela de categorias
	public function fetch_categoria()
	{
		$output = '';
		$query = '';
		$this->fetch_data_categoria($query);
        
		if($this->request->getPost('query'))
		{
			$query = $this->request->getPost('query');
		}
		$data = $this->fetch_data_categoria($query);
		$output .= '
		<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<tr>
							<th>Titulo</th>
                            <th>Link Amigável</th>
							<th>Ativo</th>
						</tr>
		';
		if($data == true)
		{
			foreach($data as $key => $row)
			{
                //altera para nome amigavel
                if ($row->Ativo == 1) {
                    $row->Ativo = '<a href="ativaDesativaCategoria/' . $row->ID . '/ ' . $row->Ativo . '">Desativar categoria</a>';
                } 
                else if ($row->Ativo == 0) {
                    $row->Ativo = '<a href="ativaDesativaCategoria/' . $row->ID . '/ ' . $row->Ativo . '">Ativar categoria</a>';
                }


				$output .= '
						<tr>
							<td>'.$row->Titulo.'</td>
                            <td>'.$row->LinkAmigavel.'</td>
							<td>'.$row->Ativo.'</td>
						</tr>
				';
			}
		}
		else
		{
			$output .= '<tr>
							<td colspan="5">Nenhum dado encontrado</td>
						</tr>';
		}
		$output .= '</table>';
		echo $output;
	}


    //ativa ou desativa uma categoria
    public function ativaDesativaCategoria($id = null, $ativo = null)
    {
        $db = new \App\Models\CategoriaModel();

        $this->primaryKey = 'id';

        if ($ativo == 1) {
            $data = [
                'ID' => $id,
                'Ativo' => 0
            ];	
        } else {
            $data = [
                'ID' => $id,
                'Ativo' => 1
            ];	
        }

        $db->save($data);
        return redirect()->to('Administrador/categoria'); 
    }

    //cria uma categoria
    public function criar_categoria()
    {
        $db = new \App\Models\CategoriaModel(); 

        $this->titulo = $this->request->getPost()['titulo'];
        $this->img = $this->request->getPost()['img'];
        $this->conteudo = $this->request->getPost()['conteudo'];
        $this->link = $this->request->getPost()['link'];

        $data = [
            'Titulo' => $this->titulo,
            'Imagem' => $this->img,
            'Conteudo' => $this->conteudo,
            'LinkAmigavel' => $this->link,
            'Ativo' => 1,
        ];

        $query = $db->save($data);

        return redirect()->to('../../'); 
    }

    //================================================================================================
    //======================================================================================

}
