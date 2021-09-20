<?php



  function acessoSite()
  {
    session_start();
    if (!$_SESSION)
    {
      echo "<a href='/FORUM/app/Views/session_login/login.php'>faça login para ter acesso ilimitado ao site!</a>";
    } else {
      echo "bem vindo: " . $_SESSION['UsuarioNome'];
      echo "<br><br><a href='/FORUM/app/Controller/Logout.php'>Logout</a><br><br>";
    }
  }

  function acessoComLogin()
  {
    session_start();
    if (!$_SESSION)
    {
      echo "<a href='/FORUM/app/Views/session_login/login.php'>faça login para ter acesso ilimitado ao site!</a>";
      exit;
    } else {
      echo "bem vindo: " . $_SESSION['UsuarioNome'];
      echo "<br><br><a href='/FORUM/app/Controller/Logout.php'>Logout</a><br><br>";
    }
  }

  function permissaoGeral(){
    //verifica se há uma varaável sessão iniciada = true
    if (!$_SESSION)
    {
      //retorna falso para que não continue o código
      return false;
    }

    $nivel_necessario = 1;
    if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] == $nivel_necessario)) {    
      //permissões para o nível
    } 
  }

  function moderador()
  {
    //verifica se há uma varaável sessão iniciada = true
    if (!$_SESSION)
    {
      //retorna falso para que não continue o código
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
    //verifica se há uma varaável sessão iniciada = true
    if (!$_SESSION)
    {
      //retorna falso para que não continue o código
      return false;
    }

    $nivel_necessario = 3;
    if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] == $nivel_necessario)) {
      //permissões para o nível
      echo "Cruds | Listas | Cursos"; 
    }
  }


?>