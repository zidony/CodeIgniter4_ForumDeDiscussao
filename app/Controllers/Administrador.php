<?php

namespace App\Controllers;

class Administrador extends BaseController
{
    public function index()
	{
		return view('includes/head') . view('administrador/usuarios');
	}

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
                            <th>Badges</th>
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

                //Badges (nome amigável)
                if ($row->Badges == 1) {
                    $row->Badges = 'Novato';
                }
                else if ($row->Badges == 2) {
                    $row->Badges = 'Veterano';
                }
                else if ($row->Badges == 3) {
                    $row->Badges = 'Mestre';
                }

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
                            <td>'.$row->Badges.'</td>
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
}
