<!DOCTYPE html>
<html lang="pt_br">
<head>
    <?php require_once('../includes/head.php'); ?>
    <link rel="stylesheet" type="text/css" href="/FORUM/app/css/style-esqueceu-senha.css">
    <title>Sessão de login - Esqueceu sua senha?</title>
</head>
<body>

    <div class="box">
        <div class="box-form">
            <div class="content-form container py-5 px-4">
                <h1>ESQUECE SUA SENHA?</h1>
                <form action="" method="post" id="">
                    <div class="row">

                        <div class="form-group col-md-6 my-4">
                            <h2>Leia!</h2><br>
                            <p>Preencha os campos com o seu Nome, E-mail e Um texto explicado por qual motivo deseja recuperar sua senha e aguarde um feedback no e-mail.</p>
                            <p>IMAGEM OU ALGUM OUTRO CONTEÚDO SOBRE A SENHA E A IMPORTÂNCIA DE GUARDA-LA</p>
                        </div>

                        <div class="form-group col-md-6 my-4">
                            <h2>Formulário de envio</h2>
                            <div class="form-group col-md-12 my-4">
                                <input type="text" class="form-control" name="nome" placeholder="Digite seu nome..." title="Digite seu nome aqui!" required  id="nome">
                            </div>
                            <div class="form-group col-md-12 my-4">
                                <input type="text" class="form-control" name="email" placeholder="Digite seu E-mail..." title="Digite seu E-mail aqui!" required  id="email">
                            </div>
                            <div class="form-group col-md-12 my-4">
                                <textarea  class="form-control" name="conteudo" rows="5" placeholder="Digite seu assunto aqui!" title="Digite seu Assunto..." required id="conteudo"></textarea>
                            </div>
                            <div class="form-group col-md-12 mt-4 text-center">
                                <input type="submit" class="button-submit py-3 my-3" id="submit" title="Clique aqui para enviar o formulário!" value="ENVIAR"><br>
                                <a href="login.php" class="button-voltar py-3">RETORNAR A SESSÃO DE LOGIN</a>
                            </div>
                        </div>
                    </div>
                    <!-- fim row -->
                </form>
            </div>
        </div>
    </div>

</body>
</html>