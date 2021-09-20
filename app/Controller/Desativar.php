<?php

    require '../Models/Usuarios.php';

    function desativarUsuario($id)
    {   
        select_user($id);
    }

   $id = $_GET['id'];

desativarUsuario($id);

?>