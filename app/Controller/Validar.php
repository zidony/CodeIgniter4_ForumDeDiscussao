<?php

    require '../Models/LoginModel.php';


    function verifica($usuario, $senha, $rm)
    {
        if (mysqli_num_rows(select_user($usuario, $senha, $rm)) != 1) {
            // Nome de usuário ou senha inválidos
            return header('Location: ../Views/session_login/login.php?error');
        } else {
            $resultado = mysqli_fetch_assoc(select_user($usuario, $senha, $rm));

            // Se a sessão não existir, inicia uma
            if (!isset($_SESSION)) session_start();

    
            $_SESSION['UsuarioID'] = $resultado['ID'];
            $_SESSION['UsuarioNome'] = $resultado['Nome'];
            $_SESSION['UsuarioNivel'] = $resultado['Nivel'];


            // Redireciona o visitante
            header("Location: ../index.php"); exit;
        }
    }
    //recebe dados do usuário
    $usuario = $_POST['usuario'];
    $senha =  $_POST['senha'];
    $rm = $_POST['rm'];

    //chama a função passando os dados nos parâmetros
    verifica($usuario, $senha, $rm);
  

    


?>