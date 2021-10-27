<?php

namespace App\Controllers;
use App\Controllers;

class ValidaSessao extends BaseController
{
    public function validarPermissaoAdm()
    {
        //caso a sessão não seja do nivel 3 'ADM', proíbe o acesso
        if (!session()->has('id')) 
        {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if (session()->nivel != 3) 
        {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        } 
    }

    public function validaSessao()
    {
        //caso a sessão não seja do nivel 3 'ADM', proíbe o acesso
        if (!session()->has('id')) 
        {
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
        else if($nivel == 3){
            $recebN = 'Administrador';
        }
        if (!session()->has('id'))
        {
            $resultado = "<a href='usuario/login' class='link-nav start-session'>INICIAR SESSÃO</a>";
            
        } else {
            $foto = session()->foto;
            $resultado = '<div class="card-perfil">
            <img src="/FORUM_CODEIGNITER/assets/img/usuarios/'.  $foto .'" alt="imagem de perfil">
            <p class="p-3">'. session()->usuario .' | '. $recebN .'</p>
            <a href="usuario/perfil/' . session()->usuario .'/'. session()->id .'" class="button">Acessar perfil de usuário</a>
        </div>';
        }
        
        echo $resultado;
    }
}
