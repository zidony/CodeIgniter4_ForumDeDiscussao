<div class="container">
    <br><br>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-2 mt-4">
            <?php 
                use App\Controllers\ValidaSessao;
                $objValida = new ValidaSessao();
                $objValida->mostraBotaoLogar(); 
            ?>
        </div>
        <div class="col-md-12 col-lg-12 col-xl-5">
            <div class="">
                <?php 
                if (!session()->has('id')) { 
                    echo '<a class="btn-footer-publicacao-alert mt-3" href="/FORUM_CODEIGNITER/public/usuario/login" role="button">
                            Faça login para fazer uma publicação
                        </a>';
                } else { 
                    echo '<div class="box-shadow mt-3">';
                    echo '<h2>Faça uma pergunta <i class="bi bi-question-lg" style="font-sze: 20px"></i></h2>';
                    helper('form');
                    echo form_open_multipart('', 'id="publicacao"');
                        echo form_label('Título');
                        echo '<br>';
                        echo form_input('titulo','', 'id="titulo" placeholder="Tente: Me ajude nessa matéria!" required class="form-control"');
                        echo '<br>';
                        
                        echo form_label('Conteúdo');
                        echo '<br>';
                        echo form_textarea('conteudo','',  'id="conteudo" placeholder="Tente: Preciso de ajuda com esse conteúdo..." required rows="2" class="form-control"');
                        echo '<br>';

                        echo form_label('Imagem');
                        echo '<br>';
                        echo form_upload('img', '', 'id="img" class="form-control"');
                        echo '<br>';

                        echo form_input('categoria', ''. $idCategoria .'', 'class="d-none" id="categoria" class="form-control"');

                        echo '<div class="text-center">';
                        echo form_submit('submit', 'Publicar', 'class="btn-publicar" title="Clique aqui para publicar"');
                        echo '</div>';
                        echo '<br><br>';
                    echo form_close(); 
                    echo '</div>'; 

                } //fechamento else
                ?>

                <div class="box_publicacao"></div>
            </div>
        </div>
        <!-- fim col -->
        <div class="col-md-12 col-lg-12 col-xl-4">
            <div>
                <h2 class="text-center box-shadow mt-3">Navegue por Categorias</h2>
                <?php
                    use App\Controllers\Home;
                    $objHome = new Home();
                    $objHome->consulta_categoria();
                    $data = $objHome->consulta_categoria();
                    foreach ($data as $key => $value) {
                        if ($data[$key]['Ativo'] == 1)
                        { ?>
                            <div class="my-3 cards-categoria-publi">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-xl-12 box-img-categoria-publi">
                                        <img src="/FORUM_CODEIGNITER/assets/img/categorias/<?php echo $data[$key]['Imagem']; ?>">
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-xl-12 box-content-categoria-publi">
                                        <h3 title="<?php echo $data[$key]['Titulo']; ?>" class="pt-3"><?php echo $data[$key]['Titulo']; ?></h3>
                                        <hr class="linha-categorias">
                                        <p><?php echo $data[$key]['Conteudo']; ?></p>
                                        <a href="/FORUM_CODEIGNITER/public/Feed/publicacoes/<?php echo $data[$key]['LinkAmigavel'] ?>/<?php echo $data[$key]['ID'] ?>" class="btn-categoria">Acessar</a><br><br><br>
                                    </div>
                                </div>
                                <!-- fim row -->
                            </div>
                    <?php 
                            } 
                        }
                    ?>
            </div>   
        </div>
        <!-- fim col -->
    </div>
    <!-- fim row -->
</div>
<!-- fim container -->
<br><br><br><br><br><br>


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
                    //imagem = '<a href="/FORUM_CODEIGNITER/assets/img/publicacoes/'+ result[i].Imagem +'" target="_blank"></a>';
                    imagem = '<img src="/FORUM_CODEIGNITER/assets/img/publicacoes/'+ result[i].Imagem +'" class="">';
                    //TESTAR ZOOM NA IMAGEM
                    //LINK EXEMPLO: https://pt.stackoverflow.com/questions/106970/aumentar-imagem-quando-o-usu%C3%A1rio-clicar-em-js
                    
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
                    
                //menu excluir e editar
                if (result[i].IDUsuario == <?php echo json_encode(session()->id) ?>) {
                    editar_publicacao_usuario = 
                    '<li class="remove-marker">' +
                        '<a class="" href="#" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false">' +
                            '<i class="bi bi-three-dots-vertical"></i>' +
                        '</a>' +
                        '<ul class="dropdown-menu" aria-labelledby="navbarDropdown">' +
                            '<input type="hidden" name="idpublicacao" id="idpublicacao" value="'+ result[i].IDPublicacao +'">' +
                            '<li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ModalEditarPublicacao" href="">Editar Publicação</a></li>' +
                            '<li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ModalEditarImagemPublicacao" href="">Editar Imagem Publicação</a></li>' +
                            '<li><a class="dropdown-item"  style="color: #bb262e;" href="/FORUM_CODEIGNITER/public/Feed/excluirPublicacaoSelecionada/'+ result[i].IDPublicacao +'">Excluir Publicação</a></li>' +
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
                                            '<img src="/FORUM_CODEIGNITER/assets/img/usuarios/'+ result[i].Foto +'" alt="" class="img-perfil">' +
                                            '<div class="text-left mx-2">' +
                                                '<b class="break-content">'+ result[i].Nome +'</b>' +
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
                        
                    //menu excluir e editar
                    if (result[i].IDUsuario == <?php echo json_encode(session()->id) ?>) {
                        editar_publicacao_usuario = 
                        '<li class="remove-marker">' +
                            '<a class="" href="#" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false">' +
                                '<i class="bi bi-three-dots-vertical"></i>' +
                            '</a>' +
                            '<ul class="dropdown-menu" aria-labelledby="navbarDropdown">' +
                                '<input type="hidden" name="idpublicacao" id="idpublicacao" value="'+ result[i].IDPublicacao +'">' +
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
                            '<div class="box-publicacao mt-4">' +
                                '<div class="row">' +
                                    '<div class="col-md-12">' +
                                        '<div class="header-publicacao p-3">' +
                                            '<div class="d-flex">' +
                                                '<img src="/FORUM_CODEIGNITER/assets/img/usuarios/'+ result[i].Foto +'" alt="" class="img-perfil">' +
                                                '<div class="text-left mx-2">' +
                                                    '<b class="break-content">'+ result[i].Nome +'</b>' +
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
    
    function EditarPublicacao(idpublicacao) {
        $.ajax({
            url: '/FORUM_CODEIGNITER/public/Feed/editarPublicacaoSelecionada/'+ idpublicacao,
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
        idpublicacao = $('#idpublicacao').val();
        EditarPublicacao(idpublicacao);
        console.log('Modal Editar Publicacao:');
    });

     //====================================================================================================
    //ALTERAR IMAGEM PUBLICAÇÃO
    function EditarImagemPublicacao(idpublicacao) {
        $.ajax({
            url: '/FORUM_CODEIGNITER/public/Feed/editarImagemPublicacaoSelecionada/'+ idpublicacao,
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
        idpublicacao = $('#idpublicacao').val();
        EditarImagemPublicacao(idpublicacao);
        console.log('Modal Editar Imagem Publicacao:');
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
    
