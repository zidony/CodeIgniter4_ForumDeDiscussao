<?php

namespace App\Controllers;
use App\Controllers;

class ValidaSessao extends BaseController
{
    public function validarPermissaoAdm()
    {
        //caso a sessão não seja do nivel 3 'ADM', proíbe o acesso
        if (!session()->has('id')) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if (session()->nivel != 3) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        } 
    }

    public function validaSessao()
    {
        //caso não haja uma sessão, proíbe o acesso
        if (!session()->has('id')) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function mostraBotaoLogar()
    {
        $nivel = session()->nivel;
        if ($nivel == 1){
            $recebN = 'Usuário';
        }
        else if($nivel == 2) {
            $recebN = 'Moderador';
        } 
        else if($nivel == 3) {
            $recebN = 'Administrador';
        }
        if (!session()->has('id')) {
            $resultado = "<br><a href='/FORUM_CODEIGNITER/public/usuario/login' class='link-nav start-session'>INICIAR SESSÃO</a><br><br><br>";
            
        } else {
            $foto = session()->foto;
            $resultado = '<div class="card-perfil">
            <img src="/FORUM_CODEIGNITER/assets/img/usuarios/'.  $foto .'" alt="'. $foto .'">
            <p class="p-3">'. session()->usuario .' | '. $recebN .'</p>
            <a href="/FORUM_CODEIGNITER/public/usuario/perfil/' . session()->id .'" class="button">Acessar perfil de usuário</a>
        </div><br>';
        }
        
        echo $resultado;
    }

    public function mostraBotaoLogarBanner()
    {
        $nivel = session()->nivel;
        if ($nivel == 1){
            $recebN = 'Usuário';
        }
        else if($nivel == 2) {
            $recebN = 'Moderador';
        } 
        else if($nivel == 3) {
            $recebN = 'Administrador';
        }
        if (!session()->has('id')) {
            $resultado = "  <a href='/FORUM_CODEIGNITER/public/usuario/login'>
                                <div class='cards-perfil'>
                                    <h2>SESSÃO:<br>INICIAR SESSÃO</h2>
                                </div>
                            </a>";
            
        } else {
            $resultado = "  <a href='/FORUM_CODEIGNITER/public/usuario/perfil/" . session()->id ."'>
                                <div class='cards-perfil'>
                                    <h2>PERFIL:<br>ACESSAR PERFIL</h2>
                                </div>
                            </a>";
        }
        
        echo $resultado;
    }

    public function mostrarFotoPerfilNav()
    {
        if (!session()->has('id')) {
            $resultado = "";
            
        } else {
            $resultado = "  <a href='/FORUM_CODEIGNITER/public/usuario/perfil/" . session()->id ."' title='Acessar perfil de usuário' class='py-3 navbar-toggler border-0'>
                                <img src='/FORUM_CODEIGNITER/assets/img/usuarios/". session()->foto ."' alt='imagem-perfil' class='img-perfil-nav'>
                            </a>";
        }
        
        echo $resultado;
    }

    //para publicações
    public function publicar()
    {
        if (!session()->had('id')) {
            $resultado = "<br><a href='/FORUM_CODEIGNITER/public/usuario/login' class='link-nav start-session'>INICIAR SESSÃO</a>";
        }
    }

    public function validaSessaoPerfil($id)
    {
        //caso não haja uma sessão, proíbe o acesso
        if (!session()->has('id')) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        else if (session()->id != $id) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function verificarPrivacidade($id, $privacidade) 
    {
        //consulta sql personalizada
        $db      = \Config\Database::connect();
        $builder = $db->table('usuario');
        $builder->select('ID, AlertaPrivacidade');
        $builder->where('ID', $id);
        // $builder->where('AlertaPrivacidade', 0);
        $query = $builder->get()->getResultArray();

        if ($query == true) {
            echo json_encode($query);
        }
    }
}
