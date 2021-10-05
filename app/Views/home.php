
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
        <p>Realizar pesquisa via input - feito</p>
        <p>Quando o usuário é desativado, pós recarregar a tela ele é deslogado do sistema - feito</p>
        <p>)</p>

        <h1>BADGES RETIRAR - alterar mer e der e script banco </h1>
        <h1>Alterar login, fazer com que a tabela rm tenha a verificação do RM e o EMAIL institucional<br>E quando for feito cadastro no site ou login, que seja pelo email institucional e pelo RM<br>Isso vai aumentar o nível de segurança</h1>
        <h1>Altear form de cadastrao, de login e add uns campos a mais nas tabelas RM, USUARIO</h1>
    </div>
    
</body>
</html>
