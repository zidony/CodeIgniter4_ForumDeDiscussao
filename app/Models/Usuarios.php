<?php

    require '../../Config/conexao.php';

    #consulta um usuário no banco para fazer login
    function select_all_user()
    {
        $select_usuario = "SELECT * FROM usuario LIMIT 15";
        $sql = mysqli_query(conect_sql(), $select_usuario);
        return $sql;  
    }
    
    #consulta um usuário no banco para fazer login
    function select_user($id)
    {
        $select_usuario = "SELECT * FROM usuario WEHRE ID = '$id'";
        $sql = mysqli_query(conect_sql(), $select_usuario);
        return $sql;  
    }






?>