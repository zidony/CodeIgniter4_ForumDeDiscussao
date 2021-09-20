<?php

        require '../Models/LoginModel.php';

        function restrito()
        {
            // A sessão precisa ser iniciada em cada página diferente
            if (!isset($_SESSION)) session_start();

            // Verifica se não há a variável da sessão que identifica o usuário
            if (!isset($_SESSION['UsuarioID'])) {
                // Destrói a sessão por segurança
                session_destroy();
                // Redireciona o visitante de volta pro login
                header("Location: ../Views/session_login/login.php"); exit;
            }
        }

    $usuario = $_POST['usuario'];
    $senha =  $_POST['senha'];
    $rm = $_POST['rm'];

    restrito();

    


?>