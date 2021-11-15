<div class="container">
    <br><br>
    <h2>Faça uma pergunta</h2>

    <div class="row">
        <div class="col-md-7">
            <div class="">
                <?php 
                if (!session()->has('id')) { 
                    echo '<a class="btn-footer-publicacao" href="/FORUM_CODEIGNITER/public/usuario/login" role="button">
                            Faça login para fazer uma publicação
                        </a>';
                } else { 
                    helper('form');
                    echo form_open_multipart('', 'id="publicacao"');
                        echo form_label('Título');
                        echo '<br>';
                        echo form_input('titulo','', 'id="titulo" required class="form-control"');
                        echo '<br><br>';
                        
                        echo form_label('Conteúdo');
                        echo '<br>';
                        echo form_textarea('conteudo','',  'id="conteudo" required rows="2" class="form-control"');
                        echo '<br><br>';

                        echo form_label('Imagem');
                        echo '<br>';
                        echo form_upload('img', '', 'id="img" class="form-control"');
                        echo '<br><br>';

                        echo form_input('categoria', ''. $idCategoria .'', 'class="d-none" id="categoria" class="form-control"');

                        echo '<div class="text-center">';
                        echo form_submit('submit', 'Publicar', 'class="btn-publicar"');
                        echo '</div>';
                        echo '<br><br>';
                    echo form_close();  

                } //fechamento else
                ?>

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
    
    //recebe dados do formulário da publicação
    $("#publicacao").submit(function(e) {
        e.preventDefault();    
        var formData = new FormData(this);

        $.ajax({
            url: '/FORUM_CODEIGNITER/public/Feed/inserir',
            type: 'POST',
            data: formData,
            // success: function (data) {
            //     alert('Publicação postada com sucesso')
            // },
            cache: false,
            contentType: false,
            processData: false
            
        }).done(function(result){
                alert('Publicação postada com sucesso')
                $('#titulo').val('');
                $('#conteudo').val('');
                $('#img').val('');
                $('#categoria');
                console.log(result);
                getPublicacao(); 
            });
    });

    //exibe o conteúdo das publicações ativas
    function getPublicacao() {
        $.ajax({
            url: '/FORUM_CODEIGNITER/public/Feed/selecionar/<?php echo $idCategoria ?>',
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
                    imagem = '';
                } else {
                    imagem = '<a href="/FORUM_CODEIGNITER/assets/img/publicacoes/'+ result[i].Imagem +'" target="_blank"><img src="/FORUM_CODEIGNITER/assets/img/publicacoes/'+ result[i].Imagem +'"></a>';
                }

                //botão de ver comentários
                ver_comentarios = '<a class="btn-footer-publicacao" href="../../topico/'+ result[i].Titulo +'/'+ result[i].IDPublicacao + '/'+ result[i].IDCategoria +'" role="button">' +
                    '<i class="bi bi-chat-right-text mx-2 icon-comment"></i>' +
                    'Entrar nesse tópico' +
                '</a>';


                //menu excluir
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
                    
                //menu excluir e editar
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
                        '<div class="box-publicacao mt-4">' +
                            '<div class="row">' +
                                '<div class="col-md-12">' +
                                    '<div class="header-publicacao p-3">' +
                                        '<div class="d-flex">' +
                                            '<a href="/FORUM_CODEIGNITER/public/Usuario/perfilPublico/'+ result[i].IDUsuario +'" target="_blank" title="Acessar o perfil do usuário"><img src="/FORUM_CODEIGNITER/assets/img/usuarios/'+ result[i].Foto +'" alt="" class="img-perfil"></a>' +
                                            '<div class="text-left mx-2">' +
                                                '<a href="/FORUM_CODEIGNITER/public/Usuario/perfilPublico/'+ result[i].IDUsuario +'" class="link-usuario " target="_blank" title="Acessar o perfil do usuário"><b class="break-content">'+ result[i].Nome +'</b></a>' +
                                                '<br>' +
                                                '<p>'+ result[i].Data + ' às ' + result[i].Hora +'</p>' +
                                            '</div>' +
                                        '</div>' +
                                        editar_publicacao + editar_publicacao_usuario +
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
                                        ver_comentarios +
                                    '</div>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                    '</div>');
            } //fim for    
     
        }); // fim .done
                  
    }
    //fim função getPublicacao
    getPublicacao();


    //REALIZA O LOAD PARA ATUALIZAR OS DADOS
    setInterval(function getPublicacao() {
        //exibe o conteúdo das publicações ativas
        function getPublicacao() {
            $.ajax({
                url: '/FORUM_CODEIGNITER/public/Feed/selecionar/<?php echo $idCategoria ?>',
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
                        imagem = '';
                    } else {
                        imagem = '<a href="/FORUM_CODEIGNITER/assets/img/publicacoes/'+ result[i].Imagem +'" target="_blank"><img src="/FORUM_CODEIGNITER/assets/img/publicacoes/'+ result[i].Imagem +'"></a>';
                    }

                    //botão de ver comentários
                    ver_comentarios = '<a class="btn-footer-publicacao" href="../../topico/'+ result[i].Titulo +'/'+ result[i].IDPublicacao + '/'+ result[i].IDCategoria +'" role="button">' +
                        '<i class="bi bi-chat-right-text mx-2 icon-comment"></i>' +
                        'Entrar nesse tópico' +
                    '</a>';


                    //menu excluir
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
                        
                    //menu excluir e editar
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
                            '<div class="box-publicacao mt-4">' +
                                '<div class="row">' +
                                    '<div class="col-md-12">' +
                                        '<div class="header-publicacao p-3">' +
                                            '<div class="d-flex">' +
                                                '<a href="/FORUM_CODEIGNITER/public/Usuario/perfilPublico/'+ result[i].IDUsuario +'" target="_blank" title="Acessar o perfil do usuário"><img src="/FORUM_CODEIGNITER/assets/img/usuarios/'+ result[i].Foto +'" alt="" class="img-perfil"></a>' +
                                                '<div class="text-left mx-2">' +
                                                    '<a href="/FORUM_CODEIGNITER/public/Usuario/perfilPublico/'+ result[i].IDUsuario +'" class="link-usuario " target="_blank" title="Acessar o perfil do usuário"><b class="break-content">'+ result[i].Nome +'</b></a>' +
                                                    '<br>' +
                                                    '<p>'+ result[i].Data + ' às ' + result[i].Hora +'</p>' +
                                                '</div>' +
                                            '</div>' +
                                            editar_publicacao + editar_publicacao_usuario +
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
                                            ver_comentarios +
                                        '</div>' +
                                    '</div>' +
                                '</div>' +
                            '</div>' +
                        '</div>');
                } //fim for    
        
            }); // fim .done
                    
        }
        //fim função getPublicacao
        getPublicacao();
    }, 60000)
    </script>
    
