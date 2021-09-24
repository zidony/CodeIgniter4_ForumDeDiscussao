
    <link rel="stylesheet" type="text/css" href="../../css/style-login.css">
    <title>Sessão de login</title>
</head>
<body>

<!-- <div class="container"> -->
    <div class="box">
        <div class="box-form">
            <div class="container content-form p-4">
                <div class="text-center">
                    <a href="../../assets/img/login/logo.png" target="_blank"><img src="../../assets/img/login/logo.png" alt="logo"></a>
                </div>

                <!-- formulário de login -->
                <form class="form-group" action="verificarLogin" method="post">
                    <h1 class="text-center my-4">INICIAR SESSÃO</h1>

                    <!-- user -->
                    <div class="form-group box-group mb-4 text-center">
                        <input class="form-control" type="text" name="usuario" required placeholder="Digite seu nome de usuário..." maxlength="25" title="Digite seu nome de usuário aqui!"/>
                    </div>

                    <!-- password -->
                    <div class="form-group box-group my-4 text-center">
                        <input class="form-control" type="password" name="senha" required placeholder="Digite sua senha..." title="Digite sua senha aqui!" />
                    </div>

                    <!-- RM -->
                    <div class="form-group box-group mb-4 text-center">
                        <input class="form-control w-50" type="text" name="rm" required placeholder="Digite seu RM..." maxlength="10" title="Digite seu RM aqui!"/>
                    </div>

                    <!-- submit -->
                    <div class="text-center">
                        <button type="submit" class="mt-4 py-3 button" title="Clique aqui para fazer login!">INICIAR SESSÃO</button><br>

                        <!-- VERIFICA SE O LOGIN E SENHA DO USUÁRI EXISTE NO DB -->
                        <?php if (isset($_GET['error'])) { echo '<br><b style="color: red;">Credências incorretas!</b>'; } ?>
                    </div>

                    <div class="text-center mt-5">
                        <a href="esqueceu-senha.php" class="link-login" title="Clique aqui caso tenha esquecido a sua senha!">ESQUECEU SUA SENHA?</a>
                        <br>
                        <a href="criar-conta.php" class="link-login" title="Clique aqui caso não tenha uma conta e deseja se cadastrar!">REGISTRE-SE </a>
                        | 
                        <a href="ajuda-suporte-login.php" class="link-login" title="Clique aqui caso tenha alguma dúvida e deseje solicitar o suporte!"> AJUDA SUPORTE</a>
                    </div>
                    
                </form>
            </div>

            <p class="text-center relative-bottom py-4 copy">@2021 ETEC SÃO ROQUE - TODOS OS DIRETOS RESERVADOS</p>
        </div>
    </div>
<!-- </div> -->
    
</body>
</html>