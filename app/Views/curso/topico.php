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
            url: '/FORUM_CODEIGNITER/public/Feed/selecionarPublicacao/<?php echo $idPublicacao ?>',
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
                    '<a class="btn-footer-topico" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">' +
                        '<i class="bi bi-chat-right mx-2 icon-comment"></i>' +
                        'Comentar' +
                    '</a>' +
                    
                    '<br>';

                //collapse (conteúdo) do botão comentar
                acao_comentario = 
                '<div class="collapse" id="collapseExample">' +
                    '<div class="box-comentario p-3">' +
                        '<div class="box_form">' +
                            '<form id="comentario">' +
                                '<textarea rows="3" name="comentar" id="comentar" class="form-control" required></textarea>' +
                                
                                '<input type="text" name="idpublicacao" id="idpublicacao" class="d-none" value="'+ result[i].IDPublicacao +'"/>' +
                                '<div class="text-center my-2">' +
                                    '<input type="submit" form="comentario" class="btn-comentar" value="Comentar"/>' +
                                '</div>' +
                                '' +
                            '</form>' +
                        '</div>' +
                    '</div>' +
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
                                    '<div class="box-footer-publicacao">' +
                                        '<a class="btn-footer-topico">' +
                                            '<i class="bi bi-chat-right-text mx-2 icon-comment"></i>' +
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
                        url: '/FORUM_CODEIGNITER/public/Feed/selecionarComentarios/<?php echo $idPublicacao; ?>',
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
    
