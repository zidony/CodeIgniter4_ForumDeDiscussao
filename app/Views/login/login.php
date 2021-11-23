
    <link rel="stylesheet" type="text/css" href="/FORUM_CODEIGNITER/public/css/style-login.css">
    <title>Iniciar Sessão</title>
</head>
<body>

<!-- <div class="container"> -->
    <div class="box">
        <div class="box-form">
            <div class="container content-form p-4">
                <div class="text-center">
                    <a href="/FORUM_CODEIGNITER/assets/img/login/logo.png" target="_blank"><img src="/FORUM_CODEIGNITER/assets/img/login/logo.png" alt="logo"></a>
                </div>

                <!-- formulário de login -->
                <form class="form-group" action="/FORUM_CODEIGNITER/public/Usuario/verificarLogin" method="post">
                    <h1 class="text-center my-4">INICIAR SESSÃO</h1>

                    <!-- user -->
                    <div class="form-group box-group mb-4 text-center">
                        <input class="form-control" type="text" name="usuario" required placeholder="Digite seu email institucional..." maxlength="100" title="Digite seu email institucional aqui!"/>
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
                    
                        <button type="submit" class="mt-4 py-3 button">INICIAR SESSÃO</button><br>

                        <!-- VERIFICA SE O LOGIN E SENHA DO USUÁRI EXISTE NO DB -->
                        <?php if (isset($_GET['error'])) { echo '<br><b style="color: red;">Credências incorretas!</b>'; } ?>
                    </div>

                    <div class="text-center mt-5">
                        <a href="esqueceuSenha" class="link-login" title="Clique aqui caso tenha esquecido a sua senha!">ESQUECEU SUA SENHA?</a>
                        <br>
                        <a href="registraUsuario" class="link-login" title="Clique aqui caso não tenha uma conta e deseja se cadastrar!">REGISTRE-SE </a>
                        | 
                        <a href="ajudaSuporte" class="link-login" title="Clique aqui caso tenha alguma dúvida e deseje solicitar o suporte!"> AJUDA SUPORTE</a>
                    </div>
                    
                </form>
            </div>

            
        </div>
    </div>
<!-- </div> -->


