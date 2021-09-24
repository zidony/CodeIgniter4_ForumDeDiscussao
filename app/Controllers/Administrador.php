<?php

namespace App\Controllers;

class Administrador extends BaseController
{
    public function listaUsuarios()
    {
        $db = new \App\Models\UsuarioModel();

        $data = $db->findAll();

        

        // echo '<pre>';
        // var_dump($data);

        $exibir['tabela'] = $data;

        return view('administrador/consulta-usuarios', $exibir);
    }

    public function consulta()
    {
        
    }
}
