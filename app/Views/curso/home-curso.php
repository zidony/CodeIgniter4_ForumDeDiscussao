<div class="container box-container">
<br><br>
    <h1>Sou a página do curso</h1>
    <br><br>

    <?php 

        $input = [
            'class' => 'form-control',
            'required' => 'required'
        ];

        $inputConteudo = [
            'class' => 'form-control',
            'required' => 'required',
            'maxlength' => '65',
            'rows' => '2'
        ];

        helper('form');
        echo form_open_multipart('', 'id="publicacao"');
            echo form_label('Título');
            echo '<br>';
            echo form_input('titulo','', 'id="titulo" required class="form-control"');
            echo '<br><br>';
            
            echo form_label('Conteúdo');
            echo '<br>';
            echo form_textarea('conteudo','',  'id="conteudo" required class="form-control"');
            echo '<br><br>';

            echo form_label('Imagem');
            echo '<br>';
            echo form_upload('img', '', 'id="img" class="form-control"');
            echo '<br><br>';

            echo form_input('categoria', ''. $idCategoria .'', 'class="d-none" id="categoria" class="form-control"');
            echo '<br><br>';

            echo '<div class="text-center">';
            echo form_submit('submit', 'Publicar', 'class="btn btn-primary"');
            echo '</div>';
        echo form_close();

        

    ?>

		<div class="box_publicacao"></div>
        <br><br><br>
    </div>
    <!-- fim container -->




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
                    imagem = '<span class=""></span>';
                } else {
                    imagem = '<a href="/FORUM_CODEIGNITER/assets/img/publicacoes/'+ result[i].Imagem +'" target="_blank"><img src="/FORUM_CODEIGNITER/assets/img/publicacoes/'+ result[i].Imagem +'"></a>';
                }

                //botão de comentar
                fazer_comentario = 
                    '<a class="btn-footer-publicacao" data-bs-toggle="collapse" href="#collapseExample'+ i +'" role="button" aria-expanded="false" aria-controls="collapseExample'+ i +'">' +
                        '<i class="bi bi-chat-right mx-2 icon-comment"></i>' +
                        'Comentar' +
                    '</a>' +
                    
                    '<br>';

                //collapse (conteúdo) do botão comentar
                acao_comentario = '<div class="collapse" id="collapseExample'+ i +'">' +
                    '<div class="box-comentario p-3">' +
                        '<div class="box_form">' +
                            '<form id="comentario'+i+'" class="d-flex align-items-center">' +
                                '<input type="text" name="comentar" id="comentar" class="form-control">' +
                                '<input type="text" name="idpublicacao" id="idpublicacao" class="d-none" value="'+ result[i].IDPublicacao +'"/>' +
                                '<input type="submit" form="comentario'+i+'" class="btn-comentar value="Comentar"/>' +
                                '<br><br>' +
                            '</form>' +
                        '</div>' +
                    '</div>' +
                '</div>';

                //botão de ver comentários
                ver_comentarios = 
                '<a class="btn-footer-publicacao" data-bs-toggle="collapse" href="#comentarios'+ i +'" role="button" aria-expanded="false" aria-controls="comentarios'+ i +'">' +
                    '<i class="bi bi-chat-right-text mx-2 icon-comment"></i>' +
                    'Ver comentários' +
                '</a>';

                acao_ver_comentarios =  
                '<div class="collapse" id="comentarios'+ i +'">' +
                    '<div class="box_comentarios"></div>' +
                '</div>';

                //conteúdo das publicações
                $('.box_publicacao').prepend(
                    '<div class="">' +
                        '<div class="box-publicacao mt-3">' +
                            '<div class="row">' +
                                '<div class="col-md-12">' +
                                    '<div class="header-publicacao p-3">' +
                                        '<div class="d-flex">' +
                                            '<img src="/FORUM_CODEIGNITER/assets/img/usuarios/'+ result[i].Foto +'" alt="" class="img-perfil">' +
                                            '<div class="text-left mx-2">' +
                                                '<b>'+ result[i].Nome +'</b>' +
                                                '<br>' +
                                                '<p>'+ result[i].Data + ' às ' + result[i].Hora +'</p>' +
                                            '</div>' +
                                        '</div>' +
                                        '<div class="">' +
                                            '<p>Ação para adm<br>Desativar post</p>' +
                                        '</div>' +
                                    '</div>' +
                                '</div>' +
                                '<div class="col-md-12">' +
                                    '<div class="box-content-post">' +
                                        '<hr>' +
                                        '<h3 class="px-3">'+ result[i].Titulo +'</h3>' +
                                        '<p class="px-3">'+ result[i].Conteudo +'</p>' +
                                        '<div class="text-center box-img-publicacao">' +
                                            imagem +
                                        '</div>' +
                                    '</div>' +
                                    '<hr>' +
                                    '<div class="box-footer-publicacao">' +
                                    fazer_comentario +
                                        ver_comentarios +
                                    '</div>' +
                                    acao_comentario +  acao_ver_comentarios +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                    '</div>');

                    //recebe dados do formulário de comentário
                    $("#comentario"+i).submit(function(e) {
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
                        url: '/FORUM_CODEIGNITER/public/Feed/selecionarComentarios/',
                        method: 'POST',
                        dataType: 'json'
                    }).done(function(resultComentarios){
                        console.log(resultComentarios);

                        var box_comment = document.querySelector('.box_comentarios');
                        while(box_comment.firstChild){
                            box_comment.firstChild.remove();
                        }

                        for (var i = 0; i < resultComentarios.length; i++) {

                            $('.box_comentarios').prepend(
                                '<div class="box-comentario mt-3">' +
                                    '<div class="row">' +
                                        '<div class="col-md-12">' +
                                            '<div class="header-comentario p-3 comentarios">' +
                                                '<div class="text-center">' +
                                                    '<img src="/FORUM_CODEIGNITER/assets/img/usuarios/'+ resultComentarios[i].Foto +'" alt="" class="img-perfil">' +
                                                    '<br>' +
                                                    '<b class="p-2">'+ resultComentarios[i].Nome +'</b>' +
                                                '</div>' +
                                                '<p class="p-4">'+ resultComentarios[i].Conteudo +'</p>' +
                                            '</div>' +  
                                            '<div class="text-end">' +
                                                '<p class="px-3">Data e hora comentado: '+ resultComentarios[i].Data + ' às ' + resultComentarios[i].Hora +'</p>' +
                                            '</div>' +
                                        '</div>' +
                                    '</div>' +
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
    
