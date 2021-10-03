
    <title>Página inicial - Fórum</title>
</head>
<body>
    <div class="container">
        <?php
            use App\Controllers\Usuario;

            if (session()->has('id'))
            {
                echo "<br><br><a href='usuario/logout'>Logout</a><br><br>";
                //chama o método nivel que terá as permissões para cada tipo de usuário logado (usuario, mod e adm)
                $obj = new Usuario();
                $obj->nivel();

            } else {
                echo "<a href='usuario/login'>faça login para ter acesso ilimitado ao site!</a>";
            }

        ?>
        <h1>Sou a index</h1>
        <br><br>
        <p>Login - feito</p>
        <p>Cadastro usuário - feito</p>
        <p>Recuperar senha - não feito (só o adm pode gerar uma senha para o usuário)</p>
        <br><br>
        <p>Lista de usuário para adm - andamento</p>
        <p>(</p>
        <p>Desativar usuário - feito</p>
        <p>Gerar senha de recuperação para o usuário - feito</p>
        <p>Realizar pesquisa via input</p>
        <p>Quando o usuário é desativado, pós recarregar a tela ele é deslogado do sistema - feito</p>
        <p>)</p>
    </div>
    
</body>
</html>
