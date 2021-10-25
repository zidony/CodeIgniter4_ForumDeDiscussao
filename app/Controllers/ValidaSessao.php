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

    public function mostraBotaoLogar()
    {
        if (!session()->has('id'))
        {
            $resultado = "<a href='usuario/login' class='link-nav start-session'>INICIAR SESSÃO</a>";
            
        } else {
            $resultado = '<a href="usuario/perfil/' . session()->id . '">Acessar perfil de usuário</a>';
        }
        echo $resultado;
    }
}
