<?php 


        session_start();
        session_destroy();
        header("Location: ../Views/session_login/login.php");
        exit; 


?>