<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('Views/includes/head.php'); ?>  
    <title>Document</title>
</head>
<body>

    <div class="container">
    <?php 
        // require 'Controller/Logout.php';
        require 'Controller/NivelAcesso.php';
        acessoSite();
        permissaoGeral();
        moderador();
        adm();
        
    ?>

    <h1>Sou a index.</h1>

    <h1><BR>- ALÉM DO NÍVEL DE ACESSO, CONSERTA FALHA DE SEGURANÇA VIA URL<br>- TELA DE AJUDA DO SUPORTE PARA O LOGIN<BR>- FAZER A PARTE DO DESATIVAMENTEO DO PERFIL<BR>- RECUPERAÇÃO DE SENHA (PENSANDO EM UMA SOLUÇÃO)<br>- ADM REALIZANDO AS VERIFICAÇÕES NAS CONSULTAS DE USUÁRIOS CADASTRADOS (PODENDO DESATIVAR, ALTERAR SENHA, BADGES)</h1>
    
    </div>
    <!-- fim container -->
</body>
</html>