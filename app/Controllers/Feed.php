<?php

namespace App\Controllers;
use App\Controllers;

class Feed extends BaseController
{
    public function curso($recebeCursos, $id)
    {
        var_dump('link amigável categoria = ' . $recebeCursos);
        var_dump('id categoria = ' . $id);

        if (!session()->has('id'))
        {
            echo 'faça login para acessar o feed ilimitado';
        }
        else {
            var_dump('id usuário logado = ' . session()->id);
            // session()->id;
        }

        return view('includes/head') .
            view('curso/title') .
            view('includes/nav') .
            // view('includes/banner-home') .
            view('curso/home-curso') .
            view('includes/footer');
    }

}
