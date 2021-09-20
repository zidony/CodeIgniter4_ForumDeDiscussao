<?php

    function conect_sql()
    {
        $host = 'localhost';
        $usuario = 'root';
        $senha = '';
        $db = 'forum';

        //criar a conexao
        $con = mysqli_connect($host, $usuario, $senha, $db);

        //ajustar o charset de comunicação entre a aplicação e o banco de dados
        mysqli_set_charset($con, 'utf-8');

        //verificar se houve erro de conexão
        if(mysqli_connect_errno()){
            echo 'Houve um erro ao tentar se conectar com o banco de dados mysqli: ' . mysqli_connect_error();
        }

        return $con;
    }


?>