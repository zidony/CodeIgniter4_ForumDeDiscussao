<div class="container">
    <br><br>
    <h2>Tópico selecionado</h2>
    <div class="row">
        <div class="col-md-7">
            <div class="">
                <div class="box_publicacao"></div>
            </div>
        </div>
        <!-- fim col -->
        <div class="col-md-5">
            <div>
                <h2>Em breve...</h2>
            </div>   
        </div>
        <!-- fim col -->
    </div>
    <!-- fim row -->
</div>
<!-- fim container -->
<br><br><br><br><br><br>




	<script>

    //exibe o conteúdo da publicação selecionada
    function getPublicacao() {
        $.ajax({
            url: '/FORUM_CODEIGNITER/public/Feed/selecionarPublicacao/<?php echo $ids[0] ?>/<?php echo $ids[1] ?>',
            method: 'POST',
            dataType: 'json'
        }).done(function(result){
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
                                '<textarea rows="3" name="comentar" id="comentar" class="form-control" required></textarea>' +

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
                                        '<li><a class="dropdown-item" href="/FORUM_CODEIGNITER/public/Feed/excluirPublicacaoSelecionada/'+ result[i].IDPublicacao +'">Excluir Publicação</a></li>' +
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
                            '<li><a class="dropdown-item" href="/FORUM_CODEIGNITER/public/Feed/editarPublicacaoSelecionada/'+ result[i].IDPublicacao +'">Editar Publicação</a></li>' +
                            '<li><a class="dropdown-item" href="/FORUM_CODEIGNITER/public/Feed/excluirPublicacaoSelecionada/'+ result[i].IDPublicacao +'">Excluir Publicação</a></li>' +
                        '</ul>' +
                    '</li>';
                    
                } else {
                    editar_publicacao_usuario = '';
                }

                //conteúdo das publicações
                $('.box_publicacao').prepend(
                    '<div class="">' +
                        '<div class="box-publicacao mt-3">' +
                            '<div class="row">' +
                                '<div class="col-md-12">' +
                                    '<div class="header-publicacao p-3">' +
                                        '<div class="d-flex">' +
                                            '<a href="/FORUM_CODEIGNITER/public/Usuario/perfilPublico/'+ result[i].IDUsuario +'" target="_blank" title="Acessar o perfil do usuário"><img src="/FORUM_CODEIGNITER/assets/img/usuarios/'+ result[i].Foto +'" alt="'+ result[i].Foto +'" class="img-perfil"></a>' +
                                            '<div class="text-left mx-2">' +
                                                '<a href="/FORUM_CODEIGNITER/public/Usuario/perfilPublico/'+ result[i].IDUsuario +'" class="link-usuario " target="_blank" title="Acessar o perfil do usuário"><b class="break-content">'+ result[i].Nome +'</b></a>' +
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
                                        '<li><a class="dropdown-item" href="/FORUM_CODEIGNITER/public/Feed/editarComentarioSelecionado/'+ resultComentarios[i].IDCOMENTARIO +'">Editar Comentário</a></li>' +
                                        '<li><a class="dropdown-item" href="/FORUM_CODEIGNITER/public/Feed/excluirComentarioSelecionado/'+ resultComentarios[i].IDCOMENTARIO +'">Excluir Comentário</a></li>' +
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
                                                        '<a href="/FORUM_CODEIGNITER/public/Usuario/perfilPublico/'+ resultComentarios[i].IDUsuario +'" target="_blank" title="Acessar o perfil do usuário"><img src="/FORUM_CODEIGNITER/assets/img/usuarios/'+ resultComentarios[i].Foto +'" alt="" class="img-perfil"></a>' +
                                                        '<br>' +
                                                        '<a href="/FORUM_CODEIGNITER/public/Usuario/perfilPublico/'+ resultComentarios[i].IDUsuario +'" class="link-usuario " target="_blank" title="Acessar o perfil do usuário"><b class="p-2 break-content">'+ resultComentarios[i].Nome +'</b></a>' +
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
                
            
        }); // fim .done
                  
    }
    //fim função getPublicacao

    getPublicacao();





    //recarrega a função pra exibir dados atualizados 
    //setInterval("getPublicacao()", 60000);
    //Quando carregar a página
    //$(function() {
        //Faz a primeira atualização
       // getPublicacao();
    //});

    
    

    </script>
    
