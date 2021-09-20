<?php

    require '../Config/conexao.php';
    // require 'Errors.php';


        #consulta um usuário no banco para fazer login
        function select_user($usuario, $senha, $rm)
        {
            $select_usuario = "SELECT ID, Nome, Senha, Nivel FROM usuario WHERE (Nome = '$usuario') AND (Senha = md5($senha)) AND (RM = '$rm') AND (Ativo = 1) LIMIT 1";
            $sql = mysqli_query(conect_sql(), $select_usuario);
            return $sql;
        }
        #=======================================================================================

        #consulta o rm para verificação de criação de conta
        function select_rm($rm, $nome)
        {
            $select_rm = "select rm.rm, rm.nome from rm where rm.rm = '$rm' and rm.nome = '$nome' or rm.rm = '$rm'";
            $sql = mysqli_query(conect_sql(), $select_rm);
            return $sql;
        }

        #consulta o rm do usuário para verificar se já existe alguém cadastrado
        function select_rm_user($rm)
        {
            $select_usuario_rm = "select usuario.rm from usuario where usuario.rm = '$rm'";
            $sql = mysqli_query(conect_sql(), $select_usuario_rm);
            return $sql;
        }

        #cadastra ou não o usuário de acordo com as duas funções a cima
        function insert_user($nome, $sobrenome, $dataNascimento, $email, $senha, $rm)
        {
            $insert_usuario = "INSERT INTO usuario(nome, sobrenome, dataNascimento,  email, senha, rm, badges, nivel, ativo) VALUES('$nome', '$sobrenome', '$dataNascimento', '$email', '$senha', '$rm', 1, 1, 1)";
            $sql = mysqli_query(conect_sql(), $insert_usuario);
            return $sql;
        }

        #=======================================================================================
        
        #atualiza os dados do usuário no banco (AQUIA A AÇÃO É FEITA PELO USUÁRIO), ou seja, dados limitado para alteração
        function update_user($nome, $email, $id)
        {
            $update_usuario = "update usuario(nome,email) set nome=$nome, email=$email where id=$id";

            $sql = mysqli_query(conect_sql(), $update_usuario);
            return $sql;
        }

        #desativa o usuário
        function inative_user($inativo, $id)
        {
            $update_usuario_inative = "update usuario set inativo = $inativo where id = $id";

            $sql = mysqli_query(conect_sql(), $update_usuario_inative);
            return $sql;
        }





?>