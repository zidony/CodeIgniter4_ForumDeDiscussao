<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" type="image/png" sizes="16x16"  href="/FORUM_CODEIGNITER/public/favicon.ico">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

    <title>Pergunta selecionada</title>
    <!-- JQUERY -->
    <script src="/FORUM_CODEIGNITER/public/js/jquery/jquery.js"></script>

    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="/FORUM_CODEIGNITER/public/css/bootstrap/bootstrap.min.css">

    <link rel="stylesheet" href="/FORUM_CODEIGNITER/public/css/style-publicacoes.css">
    <link rel="stylesheet" href="/FORUM_CODEIGNITER/public/css/style-banner.css">
    <link rel="stylesheet" href="/FORUM_CODEIGNITER/public/css/style-publicacao-telas.css">
    <link rel="stylesheet" href="/FORUM_CODEIGNITER/public/css/style-perfil.css">
    <link rel="stylesheet" href="/FORUM_CODEIGNITER/public/css/style.css">
    
    <!-- ÍCONES -->
    <link rel="stylesheet" href="/FORUM_CODEIGNITER/public/css/bootstrap/icons.css">
</head>
<body>
    
    <header>
        <nav class="navbar navbar-expand-lg navbar-light navegacao">
            <div class="container-fluid">
                <a class="navbar-brand" href="/FORUM_CODEIGNITER/public/"><img class="navbar-brand logo" src="/FORUM_CODEIGNITER/assets/img/login/logo.png" alt=""></a>

                <div class="itens-view-nav-mobile">
                    <?php 
                        use App\Controllers\ValidaSessao;
                        $objValida = new ValidaSessao();
                        $objValida->mostrarFotoPerfilNav();
                    ?>
                    <a class="navbar-toggler border-0" aria-current="page" href="/FORUM_CODEIGNITER/public/" title="home"><i class="bi bi-house-door icon-home"></i></a>
                    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="bi bi-three-dots-vertical icone-menu"></i>
                    </button>
                </div>
                <div class="collapse navbar-collapse flex-grow-0" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="link-nav active" aria-current="page" href="/FORUM_CODEIGNITER/public/" title="home"><i class="bi bi-house-door icon-home"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="link-nav" href="/FORUM_CODEIGNITER/public/#sobre">SOBRE O FÓRUM</a>
                        </li>
                            <?php
                                use App\Controllers\Usuario;

                                if (session()->has('id')){
                                    
                                    $obj = new Usuario();
                                    $obj->consultaNivel();
                                    echo "<li class='nav-item'><a href='/FORUM_CODEIGNITER/public/usuario/perfil/" . session()->id ."' class='link-nav'>PERFIL</a></li>";
                                    if (session()->nivel == 3)
                                    {
                                        echo "<li class='nav-item'><a href='/FORUM_CODEIGNITER/public/administrador/index' class='link-nav'>PAINEL ADMINISTRATIVO</a></li>";
                                    }
                                    echo "<li class='nav-item'><a href='/FORUM_CODEIGNITER/public/usuario/logout' class='link-nav logout'>LOGOUT</a></li>";
                                } else {
                                    echo "<li class='nav-item'><a href='/FORUM_CODEIGNITER/public/usuario/login' class='link-nav start-session'>INICIAR SESSÃO</a></li>";
                                }
                            ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="box-flex">
        <div class="content-left">
            <div class="left-content">
                <?php 
                    $objValida = new ValidaSessao();
                    $objValida->mostraBotaoLogar(); 
                ?>
                <div class="row">
                    <hr>
                    <h2>Atalhos</h2>
                    <div class="col-md-12 coluna-card">
                        <a href="/FORUM_CODEIGNITER/public/Home/regras">
                            <div class="cards">
                                <h2>REGRAS<br>
                                / RESPEITE, POR FAVOR!</h2>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-12 coluna-card">
                        <a href="/FORUM_CODEIGNITER/public/Home/guias">
                            <div class="cards">
                                <h2>GUIAS<br>
                                / PRIMEIRA VEZ NOS FÓRUM?</h2>
                            </div>
                        </a>
                    </div> 
                    <div class="col-md-12 coluna-card">
                        <?php
                            echo $objValida->mostraBotaoLogarBanner();
                        ?>
                        
                    </div>
                </div>
                <!-- end row -->
            </div>
        </div>
        <div class="content-publi">

            <div class="content-publicacao">
                <div class="box_publicacao"></div>
                <br><br><br><br>
            </div>
        </div>
        <div class="content-right">
            <div class="right-content">
                <div class="form-group box-shadow">
                    <h2 class="text-center">Publicações recentes</h2>
                    <div class="input-group">
                        <input type="text" name="search_text" id="search_text" placeholder="Pesquise por Título, Conteúdo... " class="form-control" />
                    </div>
                </div>
                <div id="result" class="mt-2">

                </div>
            
                <div style="clear:both"></div>
                <br><br><br><br><br><br>
            </div>
        </div>
    </div>

<!-- Button trigger modal -->

<!-- ==================================================================================================== -->
<!-- MODAL EDITAR PUBLICAÇÃO -->
<div class="modal fade" id="ModalEditarPublicacao" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar publicação</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="formPublicacaoEditar">
              
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="button-close-modal" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
<!-- ==================================================================================================== -->
<!-- MODAL EDITAR IMAGEM PUBLICAÇÃO -->
<div class="modal fade" id="ModalEditarImagemPublicacao" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar imagem publicação</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="formPublicacaoEditarImagem">
              
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="button-close-modal" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
<!-- ==================================================================================================== -->
<!-- ==================================================================================================== -->
<!-- MODAL EDITAR COMENTARIO -->
<div class="modal fade" id="ModalEditarComentario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar comentário</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="formComentarioEditar">
              
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="button-close-modal" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
<!-- ==================================================================================================== -->
<!-- MODAL EDITAR IMAGEM COMENTARIO -->
<div class="modal fade" id="ModalEditarImagemComentario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar imagem comentário</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="formComentarioEditarImagem">
              
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="button-close-modal" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
<!-- ==================================================================================================== -->
<!-- MODAL ALERTA DE PRIVACIDADE -->
<div class="modal fade" id="AlertaPrivacidade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Política de privacidade</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="resultadoPrivacidade">
                    
                </div>
                <p>Termos de politica de privacidade</p>
                
            </div>
            <div class="modal-footer">
                <a href="/FORUM_CODEIGNITER/public/Usuario/logout" class="btn btn-danger">Discordo</a>
                <div class="resultadoA"></div>
            </div>
        </div>
    </div>
</div>


<script>
    //====================================================================================================
    //exibe o conteúdo da publicação selecionada
    function getPublicacao() {
        $.ajax({
            url: '/FORUM_CODEIGNITER/public/Feed/selecionarPublicacao/<?php echo $ids[0] ?>/<?php echo $ids[1] ?>',
            method: 'POST',
            dataType: 'json'
        }).done(function(result){
            console.log('Publicação selecionada:');
            console.log(result);

            var box_comm = document.querySelector('.box_publicacao');
            while(box_comm.firstChild){
                box_comm.firstChild.remove();
            }

            for (var i = 0; i < result.length; i++) {

                //verificar se o post tem ou não imagem
                verificarImagem= result[i].Imagem;
                if (verificarImagem == ''){
                    imagem = '<span class=""></span>';
                } else {
                    imagem = '<a href="/FORUM_CODEIGNITER/assets/img/publicacoes/'+ result[i].Imagem +'" target="_blank"><img src="/FORUM_CODEIGNITER/assets/img/publicacoes/'+ result[i].Imagem +'"></a>';
                }

                //botão de ver comentários
                if (<?php echo json_encode(session()->has('id')) ?> == false) {
                    fazer_comentario = '<a class="btn-footer-publicacao" href="/FORUM_CODEIGNITER/public/usuario/login" role="button">' +
                        '<i class="bi bi-person-fill icon-comment"></i></i>' +
                        'Iniciar sessão' +
                    '</a>';
                } else {
                    fazer_comentario = 
                    '<a class="btn-footer-topico" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">' +
                        '<i class="bi bi-chat-right mx-2 icon-comment"></i>' +
                        'Comentar' +
                    '</a>' +
                    '<br>';
                }

                //collapse (conteúdo) do botão comentar
                acao_comentario = 
                '<div class="collapse" id="collapseExample">' +
                    '<div class="box-comentario p-3">' +
                        '<div class="box_form">' +
                            '<form enctype="multipart/form-data" method="post" id="comentario">' +
                                '<textarea rows="3" name="comentar" placeholder="Tente: Teste fazer este procedimento..." id="comentar" class="form-control" required></textarea>' +

                                '<input type="file" name="img[]" id="img" class="form-control">' +

                                '<input type="text" name="idpublicacao" id="idpublicacao" class="d-none" value="'+ result[i].IDPublicacao +'"/>' +
                                '<div class="text-center my-2">' +
                                    '<input type="submit" form="comentario" class="btn-comentar" value="Comentar"/>' +
                                '</div>' +
                                '' +
                            '</form>' +
                        '</div>' +
                    '</div>' +
                '</div>';

                if (<?php echo json_encode(session()->has('id')) ?> == false) {
                    editar_publicacao = '';
                } else {
                    if (<?php echo json_encode(session()->nivel) ?> == 3 || <?php echo json_encode(session()->nivel) ?> == 2) {
                        if (result[i].IDUsuario != <?php echo json_encode(session()->id) ?>) {
                            editar_publicacao = '<li class="remove-marker">' +
                                    '<a class="" href="#" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false">' +
                                        '<i class="bi bi-three-dots-vertical"></i>' +
                                    '</a>' +
                                    '<ul class="dropdown-menu" aria-labelledby="navbarDropdown">' +
                                        '<li><a class="dropdown-item" style="color: #bb262e;" href="/FORUM_CODEIGNITER/public/Feed/excluirPublicacaoSelecionada/'+ result[i].IDPublicacao +'">Excluir Publicação</a></li>' +
                                    '</ul>' +
                                '</li>';
                        } else {
                            editar_publicacao = '';
                        }
                    } else {
                            editar_publicacao = '';
                        }
                }
                    
                    
                if (result[i].IDUsuario == <?php echo json_encode(session()->id) ?>) {
                    editar_publicacao_usuario = 
                    '<li class="remove-marker">' +
                        '<a class="" href="#" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false">' +
                            '<i class="bi bi-three-dots-vertical"></i>' +
                        '</a>' +
                        '<ul class="dropdown-menu" aria-labelledby="navbarDropdown">' +
                            //'<li><a class="dropdown-item" href="/FORUM_CODEIGNITER/public/Feed/editarPublicacaoSelecionada/'+ result[i].IDPublicacao +'">Editar Publicação</a></li>' +
                            '<li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ModalEditarPublicacao" href="">Editar Publicação</a></li>' +
                            '<li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ModalEditarImagemPublicacao" href="">Editar Imagem Publicação</a></li>' +
                            '<li><a class="dropdown-item" style="color: #bb262e;" href="/FORUM_CODEIGNITER/public/Feed/excluirPublicacaoSelecionada/'+ result[i].IDPublicacao +'">Excluir Publicação</a></li>' +
                        '</ul>' +
                    '</li>';
                    
                } else {
                    editar_publicacao_usuario = '';
                }

                //conteúdo das publicações
                $('.box_publicacao').prepend(
                    '<div class="">' +
                        '<h2 class="box-shadow">Tópico selecionado <i class="bi bi-card-text" style="font-size: 20px"></i></h2>' +
                        '<div class="box-publicacao mt-3">' +
                            '<div class="row">' +
                                '<div class="col-md-12">' +
                                    '<div class="header-publicacao p-3">' +
                                        '<div class="d-flex">' +
                                            '<img src="/FORUM_CODEIGNITER/assets/img/usuarios/'+ result[i].Foto +'" alt="'+ result[i].Foto +'" class="img-perfil">' +
                                            '<div class="text-left mx-2">' +
                                                '<b class="break-content">'+ result[i].Nome +'</b>' +
                                                '<br>' +
                                                '<p>'+ result[i].Data + ' às ' + result[i].Hora +'</p>' +
                                            '</div>' +
                                        '</div>' +
                                        '<div class="">' +
                                            editar_publicacao + editar_publicacao_usuario +
                                        '</div>' +
                                    '</div>' +
                                '</div>' +
                                '<div class="col-md-12">' +
                                    '<div class="box-content-post">' +
                                        '<hr>' +
                                        '<h3 class="px-3 break-content">'+ result[i].Titulo +'</h3>' +
                                        '<p class="px-3 break-content">'+ result[i].Conteudo +'</p>' +
                                        '<div class="text-center box-img-publicacao">' +
                                            imagem +
                                        '</div>' +
                                    '</div>' +
                                    '<div class="box-footer-publicacao">' +
                                        '<a class="btn-footer-topico">' +
                                            '<i class="bi bi-arrow-down icon-comment"></i>' +
                                            'Comentários' +
                                        '</a>' +
                                        '<span class="barra-lateral"></span>' +
                                        fazer_comentario +
                                    '</div>' +
                                    acao_comentario +  '<div class="box_comentarios"></div>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                    '</div>');

                    //recebe dados do formulário de comentário
                    $("#comentario").submit(function(e) {
                        e.preventDefault();    
                        var formData = new FormData(this);

                        $.ajax({
                            url: '/FORUM_CODEIGNITER/public/Feed/inserirComentario',
                            type: 'POST',
                            data: formData,
                            cache: false,
                            contentType: false,
                            processData: false
                            
                        }).done(function(resultComentarios){
                            alert('Comentário postado com sucesso')
                            $('#comentar').val('');
                            $('#img').val('');
                            $('#idpublicacao');
                            // console.log(resultComentarios);
                            getComentarios();
                        });
                    });
                    //fim dados comentarios

            } //fim for    
            
                //faz consulta e trás os comentários
                function getComentarios() {
                    $.ajax({
                        url: '/FORUM_CODEIGNITER/public/Feed/selecionarComentarios/<?php echo $ids[0]; ?>',
                        method: 'POST',
                        dataType: 'json'
                    }).done(function(resultComentarios){
                        console.log(resultComentarios);

                        var box_comment = document.querySelector('.box_comentarios');
                        while(box_comment.firstChild){
                            box_comment.firstChild.remove();
                        }

                        for (var i = 0; i < resultComentarios.length; i++) {

                            //verificar se o comentario tem ou não imagem
                            verificarImagem= resultComentarios[i].Imagem;
                            if (verificarImagem == ''){
                                imagem = '';
                            } else {
                                imagem = '<a href="/FORUM_CODEIGNITER/assets/img/publicacoes/'+ resultComentarios[i].Imagem +'" target="_blank"><img src="/FORUM_CODEIGNITER/assets/img/publicacoes/'+ resultComentarios[i].Imagem +'"></a>';
                            }

                            if (<?php echo json_encode(session()->has('id')) ?> == false) {
                                editar_publicacao = '';
                            } else {
                                if (<?php echo json_encode(session()->nivel) ?> == 3 || <?php echo json_encode(session()->nivel) ?> == 2) {
                                    if (resultComentarios[i].IDUsuario != <?php echo json_encode(session()->id) ?>) {
                                        editar_publicacao = '<li class="remove-marker">' +
                                                '<a class="" href="#" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false">' +
                                                    '<i class="bi bi-three-dots-vertical"></i>' +
                                                '</a>' +
                                                '<ul class="dropdown-menu" aria-labelledby="navbarDropdown">' +
                                                    '<li><a class="dropdown-item" style="color: #bb262e;" href="/FORUM_CODEIGNITER/public/Feed/excluirComentarioSelecionado/'+ resultComentarios[i].IDCOMENTARIO +'">Excluir Comentário</a></li>' +
                                                '</ul>' +
                                            '</li>';
                                    } else {
                                        editar_publicacao = '';
                                    }
                                } else {
                                        editar_publicacao = '';
                                    }
                            }
                    
                    
                            if (resultComentarios[i].IDUsuario == <?php echo json_encode(session()->id) ?>) {
                                editar_publicacao_usuario = 
                                '<li class="remove-marker">' +
                                    '<a class="" href="#" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false">' +
                                        '<i class="bi bi-three-dots-vertical"></i>' +
                                    '</a>' +
                                    '<ul class="dropdown-menu" aria-labelledby="navbarDropdown">' +
                                    '<input type="hidden" name="idcomentario" id="idcomentario" value="'+ resultComentarios[i].IDCOMENTARIO +'">' +
                                    '<li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ModalEditarComentario" href="">Editar Comentário</a></li>' +
                                    '<li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ModalEditarImagemComentario" href="">Editar Imagem Comentário</a></li>' +
                                    '<li><a class="dropdown-item" style="color: #bb262e;" href="/FORUM_CODEIGNITER/public/Feed/excluirComentarioSelecionado/'+ resultComentarios[i].IDCOMENTARIO +'">Excluir Publicação</a></li>' +
                                    '</ul>' +
                                '</li>';
                                
                            } else {
                                editar_publicacao_usuario = '';
                            }

                            $('.box_comentarios').prepend(
                                '<div class="box-comentario mt-3">' +
                                    '<div class="row">' +
                                        '<div class="col-md-12">' +
                                            '<div class="header-comentario p-3 comentarios">' +
                                                '<div class="d-flex">' +
                                                    '<div class="text-center" style="width: 100px; margin-left: 10px">' +
                                                        '<img src="/FORUM_CODEIGNITER/assets/img/usuarios/'+ resultComentarios[i].Foto +'" alt="" class="img-perfil">' +
                                                        '<br>' +
                                                        '<b class="p-2 break-content">'+ resultComentarios[i].Nome +'</b>' +
                                                    '</div>' +
                                                    '<p class="p-4 break-content">'+ resultComentarios[i].Conteudo +'</p>' +
                                                    
                                                '</div>' +
                                                editar_publicacao + editar_publicacao_usuario +
                                            '</div>' +  
                                            '<div class="text-center box-img-comentario">' +
                                                imagem +
                                            '</div><br>' +
                                            '<div class="text-end">' +
                                                '<p class="px-3 datetime">Data e hora comentado: '+ resultComentarios[i].Data + ' às ' + resultComentarios[i].Hora +'</p>' +
                                            '</div>' +
                                        '</div>' +
                                    '</div><hr>' +
                                '</div>');   
                        }          
                    }); 
                }
                //fim consulta comentarios
                getComentarios();
                //REALIZA O LOAD PARA ATUALIZAR OS DADOS
                //====================================================================================================
                setInterval(function load_data() {
                    //faz consulta e trás os comentários
                    function getComentarios() {
                        $.ajax({
                            url: '/FORUM_CODEIGNITER/public/Feed/selecionarComentarios/<?php echo $ids[0]; ?>',
                            method: 'POST',
                            dataType: 'json'
                        }).done(function(resultComentarios){
                            console.log(resultComentarios);
                            var box_comment = document.querySelector('.box_comentarios');
                            while(box_comment.firstChild){
                                box_comment.firstChild.remove();
                            }
                            for (var i = 0; i < resultComentarios.length; i++) {
                                //verificar se o comentario tem ou não imagem
                                verificarImagem= resultComentarios[i].Imagem;
                                if (verificarImagem == ''){
                                    imagem = '';
                                } else {
                                    imagem = '<a href="/FORUM_CODEIGNITER/assets/img/publicacoes/'+ resultComentarios[i].Imagem +'" target="_blank"><img src="/FORUM_CODEIGNITER/assets/img/publicacoes/'+ resultComentarios[i].Imagem +'"></a>';
                                }
                                if (<?php echo json_encode(session()->has('id')) ?> == false) {
                                    editar_publicacao = '';
                                } else {
                                    if (<?php echo json_encode(session()->nivel) ?> == 3 || <?php echo json_encode(session()->nivel) ?> == 2) {
                                        if (resultComentarios[i].IDUsuario != <?php echo json_encode(session()->id) ?>) {
                                            editar_publicacao = '<li class="remove-marker">' +
                                                    '<a class="" href="#" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false">' +
                                                        '<i class="bi bi-three-dots-vertical"></i>' +
                                                    '</a>' +
                                                    '<ul class="dropdown-menu" aria-labelledby="navbarDropdown">' +
                                                        '<li><a class="dropdown-item" href="/FORUM_CODEIGNITER/public/Feed/excluirComentarioSelecionado/'+ resultComentarios[i].IDCOMENTARIO +'">Excluir Comentário</a></li>' +
                                                    '</ul>' +
                                                '</li>';
                                        } else {
                                            editar_publicacao = '';
                                        }
                                    } else {
                                            editar_publicacao = '';
                                        }
                                }
                                if (resultComentarios[i].IDUsuario == <?php echo json_encode(session()->id) ?>) {
                                    editar_publicacao_usuario = 
                                    '<li class="remove-marker">' +
                                        '<a class="" href="#" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false">' +
                                            '<i class="bi bi-three-dots-vertical"></i>' +
                                        '</a>' +
                                        '<ul class="dropdown-menu" aria-labelledby="navbarDropdown">' +
                                        '<input type="hidden" name="idcomentario" id="idcomentario" value="'+ resultComentarios[i].IDCOMENTARIO +'">' +
                                        '<li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ModalEditarComentario" href="">Editar Comentário</a></li>' +
                                        '<li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ModalEditarImagemComentario" href="">Editar Imagem Comentário</a></li>' +
                                        '<li><a class="dropdown-item" style="color: #bb262e;" href="/FORUM_CODEIGNITER/public/Feed/excluirComentarioSelecionado/'+ resultComentarios[i].IDCOMENTARIO +'">Excluir Publicação</a></li>' +
                                        '</ul>' +
                                    '</li>'; 
                                } else {
                                    editar_publicacao_usuario = '';
                                }
                                $('.box_comentarios').prepend(
                                    '<div class="box-comentario mt-3">' +
                                        '<div class="row">' +
                                            '<div class="col-md-12">' +
                                                '<div class="header-comentario p-3 comentarios">' +
                                                    '<div class="d-flex">' +
                                                        '<div class="text-center" style="width: 100px; margin-left: 10px">' +
                                                            '<img src="/FORUM_CODEIGNITER/assets/img/usuarios/'+ resultComentarios[i].Foto +'" alt="" class="img-perfil">' +
                                                            '<br>' +
                                                            '<b class="p-2 break-content">'+ resultComentarios[i].Nome +'</b>' +
                                                        '</div>' +
                                                        '<p class="p-4 break-content">'+ resultComentarios[i].Conteudo +'</p>' +
                                                        
                                                    '</div>' +
                                                    editar_publicacao + editar_publicacao_usuario +
                                                '</div>' +  
                                                '<div class="text-center box-img-comentario">' +
                                                    imagem +
                                                '</div><br>' +
                                                '<div class="text-end">' +
                                                    '<p class="px-3 datetime">Data e hora comentado: '+ resultComentarios[i].Data + ' às ' + resultComentarios[i].Hora +'</p>' +
                                                '</div>' +
                                            '</div>' +
                                        '</div><hr>' +
                                    '</div>');   
                            }        
                        });   
                    }
                    //fim consulta comentarios
                    getComentarios();
                }, 60000)
                // FIM LOAD COMENTARIOS   
        }); // fim .done       
    }
    //fim função getPublicacao
    getPublicacao();
    //====================================================================================================
    //PARA EXIBIR OS COMENTÁRIOS NA LATERAL
    $(document).ready(function(){
        load_data();  
        function load_data(query)
        {
            $.ajax({
                url:"/FORUM_CODEIGNITER/public/Feed/fetch_comentarios",
                method:"POST",
                data:{query:query},
                success:function(data){
                    $('#result').html(data);
                }
            })
        }

        $('#search_text').keyup(function(){
            var search = $(this).val();
            if(search != '')
            {load_data(search);}
            else{ load_data();}
        });

        setInterval(function load_data() {
            load_data();
            function load_data(query)
            {
                $.ajax({
                    url:"/FORUM_CODEIGNITER/public/Feed/fetch_comentarios",
                    method:"POST",
                    data:{query:query},
                    success:function(data){
                        $('#result').html(data);
                    }
                })
            }
            $('#search_text').keyup(function(){
                var search = $(this).val();
                if(search != '')
                {load_data(search);}
                else{load_data();}
            });
        }, 60000)
    });


    //====================================================================================================
    //ALTERAR PUBLICAÇÃO
    function EditarPublicacao() {
        $.ajax({
            url: '/FORUM_CODEIGNITER/public/Feed/editarPublicacaoSelecionada/<?php echo $ids[0]; ?>',
            method: 'POST',
            dataType: 'json'
        }).done(function(edicaoPublicacao){
            console.log(edicaoPublicacao)
            var box_comm = document.querySelector('.formPublicacaoEditar');
                while(box_comm.firstChild){
                    box_comm.firstChild.remove();
                }
            for (var i = 0; i < edicaoPublicacao.length; i++) {      
                $('.formPublicacaoEditar').prepend(
                    '<form id="EditandoPublicacao" method="post">' +
                        '<input type="hidden" name="idpublicacao" value="'+ edicaoPublicacao[i].IDPublicacao +'" class="form-control"><br>' +
                        '<input type="hidden" name="idconteudo" value="'+ edicaoPublicacao[i].IDConteudo +'" class="form-control"><br>' +
                        '<label>Título da publicação</label>' +
                        '<input type="text" name="titulo" value="'+ edicaoPublicacao[i].Titulo +'" class="form-control" required><br>' +
                        '<label>Conteúdo da publicação</label>' +
                        '<textarea name="conteudo" rows="3" class="form-control" required>'+ edicaoPublicacao[i].Conteudo +'</textarea>' +
                        '<div class="text-center">' +
                            '<input type="submit" form="EditandoPublicacao" value="Alterar dados" class="button-editar-publi">' +
                        '</div>' +
                    '</form>'
                ); 
            } 
            //recebe dados do formulário da publicação
            $("#EditandoPublicacao").submit(function(e) {
                e.preventDefault();    
                var formData = new FormData(this);

                $.ajax({
                    url: '/FORUM_CODEIGNITER/public/Feed/editarPublicacao',
                    type: 'POST',
                    data: formData,
                    // success: function (data) {
                    //     alert('Publicação postada com sucesso')
                    // },
                    cache: false,
                    contentType: false,
                    processData: false
                    
                }).done(function(){
                        alert('Publicação alterada com sucesso!')
                        $('#titulo').val('');
                        $('#conteudo').val('');
                        $('#idpublicacao');
                        $('#idconteudo');
                        $('.modal').modal('hide');
                        getPublicacao();
                    }).fail(function(){
                        alert('Falha ao alterar dados!')
                        $('.modal').modal('hide');
                    });
            });
        }); // fim .done
                
    }

    //teste modal
    $('#ModalEditarPublicacao').on('show.bs.modal', function (e) {
        EditarPublicacao();
        console.log('Modal Editar Publicacao:');
    });

     //====================================================================================================
    //ALTERAR IMAGEM PUBLICAÇÃO
    function EditarImagemPublicacao() {
        $.ajax({
            url: '/FORUM_CODEIGNITER/public/Feed/editarImagemPublicacaoSelecionada/<?php echo $ids[0]; ?>',
            method: 'POST',
            dataType: 'json'
        }).done(function(teste){
            console.log(teste)
            var box_comm = document.querySelector('.formPublicacaoEditarImagem');
                while(box_comm.firstChild){
                    box_comm.firstChild.remove();
                }
            for (var i = 0; i < teste.length; i++) {      
                $('.formPublicacaoEditarImagem').prepend(
                    '<form id="EditandoImagemPublicacao" method="post" enctype="multipart/form-data">' +
                        '<input type="hidden" name="idpublicacao" id="idpublicacao" value="'+ teste[i].IDPublicacao +'" class="form-control"><br>' +
                        '<input type="hidden" name="idimagem" id="idimagem" value="'+ teste[i].IDImagem +'" class="form-control"><br>' +
                        '<label>Alterar imagem</label>' +
                        '<input type="file" name="img[]" id="img" value="'+ teste[i].Imagem +'" class="form-control"><br>' +
                        '<div class="text-center">' +
                            '<input type="submit" form="EditandoImagemPublicacao" value="Alterar dados" class="button-editar-publi">' +
                        '</div>' +
                    '</form>'
                ); 
            } 
            //recebe dados do formulário da publicação
            $("#EditandoImagemPublicacao").submit(function(e) {
                e.preventDefault();    
                var formData = new FormData(this);

                $.ajax({
                    url: '/FORUM_CODEIGNITER/public/Feed/editarImagemPublicacao',
                    type: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false
                    
                }).done(function(){
                        alert('Imagem da publicação alterada com sucesso!')
                        $('#img').val('');
                        $('#idpublicacao');
                        $('#idimagem');
                        $('.modal').modal('hide');
                        getPublicacao();
                    }).fail(function(){
                        alert('Falha ao alterar imagem!')
                        $('.modal').modal('hide');
                    });
            });
        }); // fim .done
                
    }

    //teste modal
    $('#ModalEditarImagemPublicacao').on('show.bs.modal', function (e) {
        EditarImagemPublicacao();
        console.log('Modal Editar Imagem Publicacao:');
    });
    //====================================================================================================

    //====================================================================================================
    //ALTERAR COMENTARIO
    
    function EditarComentario(idcomentario) {
        $.ajax({
            url: '/FORUM_CODEIGNITER/public/Feed/editarComentarioSelecionada/'+ idcomentario,
            method: 'POST',
            dataType: 'json'
        }).done(function(edicaoComentario){
            console.log(edicaoComentario)
            var box_comm = document.querySelector('.formComentarioEditar');
                while(box_comm.firstChild){
                    box_comm.firstChild.remove();
                }
            for (var i = 0; i < edicaoComentario.length; i++) {      
                $('.formComentarioEditar').prepend(
                    '<form id="EditandoComentario" method="post">' +
                        '<input type="hidden" name="idconteudo" id="idconteudo" value="'+ edicaoComentario[i].IDConteudoComentario +'" class="form-control"><br>' +
                        '<label>Título do comentário</label>' +
                        '<label>Conteúdo do comentário</label>' +
                        '<textarea name="conteudo" id="conteudo" rows="3" class="form-control" required>'+ edicaoComentario[i].Conteudo +'</textarea>' +
                        '<div class="text-center">' +
                            '<input type="submit" form="EditandoComentario" value="Alterar dados" class="button-editar-publi">' +
                        '</div>' +
                    '</form>'
                ); 
            } 
            //recebe dados do formulário da publicação
            $("#EditandoComentario").submit(function(e) {
                e.preventDefault();    
                var formData = new FormData(this);

                $.ajax({
                    url: '/FORUM_CODEIGNITER/public/Feed/editarComentario',
                    type: 'POST',
                    data: formData,
                    // success: function (data) {
                    //     alert('Publicação postada com sucesso')
                    // },
                    cache: false,
                    contentType: false,
                    processData: false
                    
                }).done(function(){
                        alert('Comentário alterado com sucesso!')
                        $('#conteudo').val('');
                        $('#idconteudo');
                        $('.modal').modal('hide');
                        getPublicacao();
                    }).fail(function(){
                        alert('Falha ao alterar dados!')
                        $('.modal').modal('hide');
                    });
            });
        }); // fim .done
                
    }

    //teste modal
    $('#ModalEditarComentario').on('show.bs.modal', function (e) {
        idcomentario = $('#idcomentario').val();
        EditarComentario(idcomentario);
        console.log('Modal Editar Comentário:');
    });

     //====================================================================================================
    //ALTERAR IMAGEM PUBLICAÇÃO
    function EditarImagemComentario(idcomentario) {
        $.ajax({
            url: '/FORUM_CODEIGNITER/public/Feed/editarComentarioSelecionada/'+ idcomentario,
            method: 'POST',
            dataType: 'json'
        }).done(function(editandoImagem){
            console.log(editandoImagem)
            var box_comm = document.querySelector('.formComentarioEditarImagem');
                while(box_comm.firstChild){
                    box_comm.firstChild.remove();
                }
            for (var i = 0; i < editandoImagem.length; i++) {      
                $('.formComentarioEditarImagem').prepend(
                    '<form id="EditandoImagemComentario" method="post" enctype="multipart/form-data">' +
                        '<input type="hidden" name="idimagem" id="idimagem" value="'+ editandoImagem[i].IDImagem +'" class="form-control"><br>' +
                        '<label>Alterar imagem</label>' +
                        '<input type="file" name="img[]" id="img" value="'+ editandoImagem[i].Imagem +'" class="form-control"><br>' +
                        '<div class="text-center">' +
                            '<input type="submit" form="EditandoImagemComentario" value="Alterar dados" class="button-editar-publi">' +
                        '</div>' +
                    '</form>'
                ); 
            } 
            //recebe dados do formulário da publicação
            $("#EditandoImagemComentario").submit(function(e) {
                e.preventDefault();    
                var formData = new FormData(this);

                $.ajax({
                    url: '/FORUM_CODEIGNITER/public/Feed/editarImagemComentario',
                    type: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false
                    
                }).done(function(){
                        alert('Imagem do comentário alterada com sucesso!')
                        $('#img').val('');
                        $('#idimagem');
                        $('.modal').modal('hide');
                        getPublicacao();
                    }).fail(function(){
                        alert('Falha ao alterar imagem!')
                        $('.modal').modal('hide');
                    });
            });
        }); // fim .done
                
    }

    //teste modal
    $('#ModalEditarImagemComentario').on('show.bs.modal', function (e) {
        idcomentario = $('#idcomentario').val();
        EditarImagemComentario(idcomentario);
        console.log('Modal Editar Imagem Comentario:');
    });
    //====================================================================================================
    //ALERTA PRIVACIDADE
    $(document).ready(function(){
        function verificar_privacidade()
        {
            $.ajax({
                url:"/FORUM_CODEIGNITER/public/ValidaSessao/verificarPrivacidade/" + <?php echo json_encode(session()->id) ?> + "/" + <?php echo json_encode(session()->privacidade) ?>,
                method: 'POST',
                dataType: 'json'
                }).done(function(alertaPrivacidade){
                    console.log(alertaPrivacidade);
                    // var box_comment = document.querySelector('.resultadoPrivacidade');
                    // while(box_comment.firstChild){
                    //     box_comment.firstChild.remove();
                    // }
                    for (var i = 0; i < alertaPrivacidade.length; i++) {

                        if (<?php echo json_encode(session()->has('id')) ?> == false) {
                            
                        } else {
                            if (<?php echo json_encode(session()->privacidade) ?> == 0) {
                                $('#AlertaPrivacidade').modal('show');
                            } else {
                                $('#AlertaPrivacidade').modal('hide');
                            }
                        }
                        $('.resultadoA').prepend(
                            '<form method="post" id="formPrivacidade">' +
                                '<input type="hidden" id="idusuario" name="idusuario" value="'+ alertaPrivacidade[i].ID +'">' +
                                '<button type="submit" form="formPrivacidade" class="btn btn-primary">Concordo</button>' +
                            '</form>');
                    }   
                    $("#formPrivacidade").submit(function(e) {
                        e.preventDefault();    
                        var formData = new FormData(this);

                        $.ajax({
                            url: '/FORUM_CODEIGNITER/public/Usuario/privacidadeConfirmar',
                            type: 'POST',
                            data: formData,
                            cache: false,
                            contentType: false,
                            processData: false
                            
                        }).done(function(){
                            
                            $('#idusuario');
                            alert('Você concordou com os dados de privacidade, curta o conteúdo com boas práticas!')
                            $('#AlertaPrivacidade').modal('hide');
                        });
                    });   
            });
        }
        verificar_privacidade();   
    });

    
</script>
<script src="/FORUM_CODEIGNITER/public/js/popper.min.js"></script>
<script src="/FORUM_CODEIGNITER/public/js/bootstrap.min.js"></script>

</body>
</html>