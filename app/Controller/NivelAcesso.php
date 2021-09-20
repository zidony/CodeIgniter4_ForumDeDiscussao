<?php


  // caso não haja uma sessão, pedi para iniciar uma
  function acessoSite()
  {
    session_start(); # Inicia sessão
    if (!$_SESSION)
    {
      echo "<a href='/FORUM/app/Views/session_login/login.php'>faça login para ter acesso ilimitado ao site!</a>";
    } else {
      echo "bem vindo: " . $_SESSION['UsuarioNome'];
      echo "<br><br><a href='/FORUM/app/Controller/Logout.php'>Logout</a><br><br>";
    }
  }

  // Permissão geral para acessar o site
  function permissaoGeral(){
    if (!$_SESSION)
    {
      return false; 
    }

    $nivel_necessario = 1;
    if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] == $nivel_necessario)) {    
      //permissões para o nível
    } 
  }

  function moderador()
  {
    if (!$_SESSION)
    {
      return false;
    }

    $nivel_necessario = 2;
    if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] == $nivel_necessario)) {
      //permissões para o nível
      echo "Publicações | Usuários"; 
    }
  }

  function adm()
  {
    if (!$_SESSION)
    {
      return false;
    }

    $nivel_necessario = 3;
    if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] == $nivel_necessario)) {
      //permissões para o nível
      echo '<a href="">Banner principal</a>'; 
      echo '<br>';
      echo '<a href="">Banner notícias</a>'; 
      echo '<br>';
      echo '<a href="">Cria categoria</a>'; 
      echo '<br>';
      echo '<a href="Views/session_adm/registro-usuarios.php" class="btn btn-primary">Usuários registrados</a>'; 
      echo '<br>';
    }
  }


?>