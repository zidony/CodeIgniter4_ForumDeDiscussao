<?php

namespace App\Controllers;

class Administrador extends BaseController
{
    //a index é definida comoa a tabela de usuários
    public function index()
	{
		return view('includes/head') .
                view('titles/title-painel') .
                view('includes/nav') .
                view('administrador/painel') . 
                view('includes/footer');
	}

    public function usuarios()
	{
		return view('includes/head') .
                view('titles/title-usuarios') . 
                view('includes/nav') .
                view('administrador/usuarios') . 
                view('includes/footer');
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
        $builder->limit(10);
        $builder->orderBy('ID', 'DESC');
        return $builder->get()->getResult();
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
					<table class="table table-bordered table-striped table-light">
						<tr>
							<th>NOME</th>
                            <th>SOBRENOME</th>
							<th>E-MAIL</th>
							<th>RM</th>
                            <th>NÍVEL</th>
                            <th>ELEGER USUÁRIO</th>
                            <th>STATUS</th>
                            <th>GERAR SENHA</th>
						</tr>
		';
		if($data == true)
		{
			foreach($data as $key => $row)
			{
                $row->GerarSenha = '<a href="senha/' . $row->ID . '" class="nav-link">Gerar senha</a>';
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
                    $row->Ativo = '<a href="ativaDesativaUsuario/' . $row->ID . '/ ' . $row->Ativo . '" class="nav-link">Desativar usuário</a>';
                } 
                else if ($row->Ativo == 0) {
                    $row->Ativo = '<a href="ativaDesativaUsuario/' . $row->ID . '/ ' . $row->Ativo . '" class="nav-link">Ativar usuário</a>';
                }

                // para eleger um usuário apo subir ou descer de nível
                $row->Eleger = '<a href="elegerUsuario/' . $row->ID . '" class="nav-link">Eleger usuário</a>';

				$output .= '
						<tr>
							<td>'.$row->Nome.'</td>
                            <td>'.$row->Sobrenome.'</td>
							<td>'.$row->Email.'</td>
							<td>'.$row->RM.'</td>
                            <td>'.$row->Nivel.'</td>
                            <td>'.$row->Eleger.'</td>
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

    //eleger usuários
    public function elegerUsuario($id = null)
    {
        $db = new \App\Models\UsuarioModel();

        $data = $db->find($id);
        $usuario['usuario'] = $data;
        return view('includes/head') . 
                view('titles/title-eleger-usuario') .
                view('includes/nav') .
                view('administrador/eleger-usuario', $usuario) . 
                view('includes/footer');
    }

    //elegendo usuário selecionado
    public function usuarioElegido()
    {
        $db = new \App\Models\UsuarioModel();

        $this->id = $this->request->getPost()['ID'];
        $this->nome = $this->request->getPost()['Nome'];
        $this->email = $this->request->getPost()['Email'];
        $this->nivel = $this->request->getPost()['Nivel'];

        $this->primaryKey = 'id';
    
        $data = [
            'ID' => $this->id, 
            'Nome' => $this->nome,
            'Email' => $this->email,
            'Nivel' => $this->nivel
        ];

        $result = $db->save($data);
        if ($result == true)
        {
            return redirect()->to('Administrador/usuarios'); 
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
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
        return redirect()->to('Administrador/usuarios'); 
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

            return view('includes/head') .
                    view('titles/title-senha-usuario') .
                    view('includes/nav') .
                    view('administrador/gerar-senha', $data) . 
                    view('includes/footer');
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
        return  view('includes/head') .
                view('titles/title-categorias') . 
                view('includes/nav') .
                view('administrador/categoria') .
                view('includes/footer');
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
        $builder->limit(10);
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
					<table class="table table-bordered table-striped table-light">
						<tr>
							<th>TÍTULO</th>
                            <th>LINK AMIGÁVEL</th>
							<th>STATUS</th>
						</tr>
		';
		if($data == true)
		{
			foreach($data as $key => $row)
			{
                //altera para nome amigavel
                if ($row->Ativo == 1) {
                    $row->Ativo = '<a href="ativaDesativaCategoria/' . $row->ID . '/ ' . $row->Ativo . '" class="nav-link">Desativar categoria</a>';
                } 
                else if ($row->Ativo == 0) {
                    $row->Ativo = '<a href="ativaDesativaCategoria/' . $row->ID . '/ ' . $row->Ativo . '" class="nav-link">Ativar categoria</a>';
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
        $this->imagecategoria = $this->request->getFiles()['img'];
        $this->conteudo = $this->request->getPost()['conteudo'];
        $this->link = $this->request->getPost()['link'];

        if($imagefile = $this->imagecategoria)
          {
             foreach($imagefile as $img)
             {
                if ($img->isValid() && ! $img->hasMoved()) {
                    $Name = $img->getRandomName();
                    $img->move(WRITEPATH.'../assets/img/categorias/', $Name);   
                    
                }  
             }
          }
          
        $data = [
            'Titulo' => $this->titulo,
            'Imagem' => $Name,
            'Conteudo' => $this->conteudo,
            'LinkAmigavel' => $this->link,
            'Ativo' => 1,
        ];

        $query = $db->save($data);

        return redirect()->to('../../');
         
    }

    //================================================================================================
    public function rm()
    {
        return  view('includes/head') .
                view('titles/title-rm') .
                view('includes/nav') .
                view('administrador/rm') .
                view('includes/footer');
    }

     //consulta sql para trazer a lista das categorias
     public function fetch_data_rm($query)
     {
         $db      = \Config\Database::connect();
         $builder = $db->table('rm');
         $builder->select('*');
         if($query != '')
         {
             $builder->Like('RM', $query);
             $builder->orLike('Nome', $query);
         }
         $builder->orderBy('ID', 'DESC');
         $builder->limit(10);
         return $builder->get()->getResult();
     }
 
     //view da tabela de categorias
     public function fetch_rm()
     {
         $output = '';
         $query = '';
         $this->fetch_data_rm($query);
         
         if($this->request->getPost('query'))
         {
             $query = $this->request->getPost('query');
         }
         $data = $this->fetch_data_rm($query);
         $output .= '
         <div class="table-responsive">
                     <table class="table table-bordered table-striped table-light">
                         <tr>
                            <th>NOME</th>
                            <th>RM</th>
                            <th>STATUS</th>
                            <th>SELECIONAR</th>
                         </tr>
         ';
         if($data == true)
         {
             foreach($data as $key => $row)
             {
                if ($row->Ativo == 1){
                    
                    $status = '<a href="ativaDesativaRM/' . $row->ID . '/' . $row->RM . '/' . $row->Ativo . '">Desativar usuário</a>';
                    $row->Ativo = 'Ativo';
                } else {
                    
                    $status = '<a href="ativaDesativaRM/' . $row->ID . '/' . $row->RM .'/' . $row->Ativo . '">Ativar usuário</a>';
                    $row->Ativo = 'Inativo';
                }

                 $output .= '
                        <tr>
                            <td>'.$row->Nome.'</td>
                            <td>'.$row->RM.'</td>
                            <td>'.$row->Ativo.'</td>
                            <td>'. $status .'</td>
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

     public function ativaDesativaRM($id, $rm, $ativo)
     {
        $dbRM = new \App\Models\RMModel();
        $dbUser     = \Config\Database::connect();

        $this->primaryKey = 'rm';

        if ($ativo == 1) {
            $dataRM = [
                'ID' => $id,
                'Ativo' => 0
            ];	

        $builder = $dbUser->table('usuario');
        $builder->set('Ativo', 0);
        $builder->where('RM', $rm);
   
        } else {
            $dataRM = [
                'ID' => $id,
                'Ativo' => 1
            ];
            
            $builder = $dbUser->table('usuario');
            $builder->set('Ativo', 1);
            $builder->where('RM', $rm); 
        }

        $dbRM->save($dataRM);

        $builder->update();
        $builder->get()->getResultArray();

        return redirect()->to('Administrador/rm'); 
     }

     public function registraRM()
     {
        $dbM = new \App\Models\RMModel();
        $db     = \Config\Database::connect();

        $this->rm = $this->request->getPost()['rm'];
        $this->nome = $this->request->getPost()['nome'];
        $this->email = $this->request->getPost()['email']; 

        $data = [
            'RM' => $this->rm,
            'Nome' => $this->nome,
            'Email' => $this->email,
            'Ativo' => 1
        ];

        $builder = $db->table('rm');
        $builder->where('RM', $this->rm);
        $query = $builder->get()->getResultArray();

        if ($query == false)
        {
            $dbM->save($data);
            $result = redirect()->to('Administrador/rm'); 
        } else {
            $result = redirect()->to('Administrador/rm?error'); 
        }

        return $result;
     }
    //================================================================================================

}
