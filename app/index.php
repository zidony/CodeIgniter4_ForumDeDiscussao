<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>


<?php 
    // require 'Controller/Logout.php';
    require 'Controller/NivelAcesso.php';
    acessoSite();
    permissaoGeral();
    moderador();
    adm();
    
 ?>


<body>
    <h1>Sou a index.</h1>

    <h1><BR>- ALÉM DO NÍVEL DE ACESSO, CONSERTA FALHA DE SEGURANÇA VIA URL<br>- TELA DE RECUPERAR SENHA<br>- TELA DE AJUDA DO SUPORTE PARA O LOGIN<br><br><br><br>- ENTRE ESSES, PENSAR SOBRE COMO VAMOS TRATAR O RESGATE DA SENHA E AJUDA DO SUPORTE</h1>
    
</body>
</html>