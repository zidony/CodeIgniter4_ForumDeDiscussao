<?php

namespace App\Controllers;
use App\Controllers;

class ValidaSessao extends BaseController
{
    public function validar()
    {
        // $usuario = new usuario();
        // $usuario->consultaNivel();

        if (!session()->has('id')) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        // else if (!session()->nivel != 3) {
        //     throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        // }
    }
}
