<!DOCTYPE html>
<html lang="pt_br">
<head>
    <?php require_once('../includes/head.php'); ?>
    <link rel="stylesheet" type="text/css" href="/FORUM/app/css/style-sessao-adm.css">
    <title>Sessão Administrador - Usuários cadastrados</title>
</head>
<body>

    <div class="container mt-5">
        <h1>Registro de usuários</h1>
        <br>
        <a href="../../index.php" class="btn btn-info">Voltar</a>
        <br><br>
        
        <table class="table">
            <tr class="table-dark">
                <td>Código</td>
                <td>RM</td>
                <td>Nome</td>
                <td>Email</td>
                <td>Foto</td>
                <td>Badges</td>
                <td>Nivel</td>
                <td>Ativo</td>
                <td>Alterar</td>
                <td>Recuperar senha</td>
                <td>Desativar</td>
            </tr>
            <?php
                require_once('../../Controller/Administracao.php');
                listaUsuarios();
            ?>
            <?php foreach (select_all_user() as $key => $value) { ?>
                <tr>
                    <td><?php echo $value['ID']; ?></td>
                    <td><?php echo $value['RM']; ?></td>
                    <td><?php echo $value['Nome']; ?></td>
                    <td><?php echo $value['Email']; ?></td>
                    <td><img src="<?php echo $value['Foto']; ?>" alt=""></td>
                    <td><?php verificaBadges($value); ?></td>
                    <td><?php verificaNivel($value); ?></td>
                    <td><?php verificaAtivo($value); ?></td>
                    <td><a href="<?php echo $value['ID']; ?>" class="btn btn-primary">Alterar</a></td>
                    <td><a href="<?php echo $value['ID']; ?>" class="btn btn-success">Recuperar senha</a></td>
                    <td><a href="../../Controller/Desativar.php?id=<?php echo $value['ID']; ?>" class="btn btn-danger">Desativar</a></td>
                </tr>
            <?php } ?>
        </table>
    </div>
    
</body>
</html>