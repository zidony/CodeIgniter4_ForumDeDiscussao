
    <link rel="stylesheet" type="text/css" href="/FORUM_CODEIGNITER/public/css/style-criar-conta.css">
    <title>Criar Conta de Usuário</title>
</head>
<body>

<div class="box">
        <div class="box-form">
            <div class="content-form container py-5 px-4">
                <h1>RESGISTRE-SE</h1>
                <form action="/FORUM_CODEIGNITER/public/Usuario/cadastroUsuario" method="post">
                    <div class="row">
                        <div class="form-group col-md-6 my-2">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control" name="usuario" placeholder="NOME" title="Digite seu nome aqui!" required  id="nome">
                        </div>
                        <div class="form-group col-md-6 my-2">
                            <label for="sobrenome">Sobrenome</label>
                            <input type="text" class="form-control" name="sobrenome" placeholder="SOBRENOME" title="Digite seu sobrenome aqui!" required id="sobrenome">
                        </div>
                        <div class="form-group col-md-6 my-2">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="email" placeholder="Email institucional" title="Digite seu e-mail aqui!" required id="email">
                        </div>
                        <div class="form-group col-md-6 my-2">
                            <label for="rm">RM</label>
                            <input type="text" class="form-control" name="rm" placeholder="RM" title="Digite seu RM aqui!" required id="codigo">
                        </div>
                        <div class="form-group col-md-6 my-2">
                            <label for="dtnascimento">Data de nascimento</label>
                            <input type="date" class="form-control" name="dtnascimento" title="Digite sua data de nascimento aqui!" required id="dtnascimento">
                        </div>
                        <div class="form-group col-md-6 my-2">
                            <label for="senha">Senha</label>
                            <input type="password" class="form-control" name="senha" placeholder="SENHA" title="Digite sua senha aqui!" required id="senha">
                        </div>

                        <div class="text-center">
                            <!-- VERIFICAÇÃO SE O NOME DE USUÁRIO OU SENHA ESTÃO CORRETOS PARA CADASTRO OU SE O RM JÁ ESTÁ CADSATRO NO DB -->
                            <?php 
                                if (isset($_GET['UsuarioInativo'])) { echo '<b style="color: red;">Usuário inativo em nosso banco de dados</b>'; }
                                if (isset($_GET['Email-Invalido'])) { echo '<b style="color: red;">E-mail digitado não consta em nosso banco de dados, certifique-se se digitou o e-mail institucional correto para cadastro.</b>'; }
                                if (isset($_GET['RM-Invalido'])) { echo '<b style="color: red;">RM digitado não consta em nosso banco de dados, certifique-se se digitou o RM correto para cadastro.</b>'; } 
                                if (isset($_GET['RM-JaRegistrado'])) { echo '<b style="color: red;">RM digitado já consta em nosso banco de dados, verifique se já tem uma conta de usuário registrada no sistema ou se digitou o RM correto.</b>'; } 
                             ?>
                        </div>

                        <div class="form-group col-md-12 mt-4 text-center">
                            <input type="submit" class="button-submit py-3 my-3" id="submit" title="Clique aqui para cirar sua conta!" value="CRIAR"><br>
                            <a href="login" class="button-voltar py-3">RETORNAR A SESSÃO DE LOGIN</a>
                        </div>
                    </div>
                    <!-- fim row -->
                </form>
            </div>
        </div>
    </div>
