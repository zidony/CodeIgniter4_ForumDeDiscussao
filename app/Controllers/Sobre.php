<?php

namespace App\Controllers;

class Sobre extends BaseController
{
   public function regras()
   {
    return 
    view('includes/head') .
    view('titles/title-regras') .
    view('includes/nav') .
    view('sobre/regras') .
    view('includes/footer');
   }  

   public function guias()
   {
    return 
    view('includes/head') .
    view('titles/title-guias') .
    view('includes/nav') .
    view('sobre/guias') .
    view('includes/footer');
   }

   public function ajuda()
   {
    return 
    view('includes/head') .
    view('titles/title-ajuda') .
    view('includes/nav') .
    view('sobre/ajuda') .
    view('includes/footer');
   }

 
}