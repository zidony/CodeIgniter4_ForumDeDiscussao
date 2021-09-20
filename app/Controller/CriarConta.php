<?php

        require '../Models/LoginModel.php';


        function verifica($nome, $sobrenome, $dataNascimento, $email, $senha, $rm)
        {
            select_rm($rm, $nome);
            if(mysqli_num_rows(select_rm($rm, $nome)) == 0) 
            {
                // echo "RM não existe em nosso banco de dados, certifique-se de que digitou o RM correto!";
                header('Location: ../Views/session_login/criar-conta.php?error');
                exit;
            }else {
                select_rm_user($rm);
                if (mysqli_num_rows(select_rm_user($rm)) == 1) 
                {
                    // echo "Esse RM já está vinculado a uma conta, certifique-se se digitou o RM correto <br> Enviamos um e-mail para a conta vinculada exibindo seu login de acesso.";
                    header('Location: ../Views/session_login/criar-conta.php?error2');
                    exit;
                } else {
                    insert_user($nome, $sobrenome, $dataNascimento, $email, $senha, $rm);
                    select_rm_user($rm);
                    header('Location: ../Views/session_login/conta-criada-com-sucesso.php');
                }
            }
        }

        $nome = $_POST['nome'];
        $sobrenome = $_POST['sobrenome'];
        $dataNascimento = $_POST['dtnascimento'];
        $email = $_POST['email'];
        $senha = md5($_POST['senha']);
        $rm = $_POST['rm'];

        
        verifica($nome, $sobrenome, $dataNascimento, $email, $senha, $rm);




?>