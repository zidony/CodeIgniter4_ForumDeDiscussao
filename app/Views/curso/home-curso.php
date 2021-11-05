<div class="container">
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
            url: 'http://localhost/FORUM_CODEIGNITER/public/Feed/inserir',
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
                // $('#img').val('');
                $('#categoria');
                console.log(result);
                getPublicacao(); 
            });
    });

    //exibe o conteúdo das publicações ativas
    function getPublicacao() {
        $.ajax({
            url: 'http://localhost/FORUM_CODEIGNITER/public/Feed/selecionar/<?php echo $idCategoria ?>',
            method: 'POST',
            dataType: 'json'
        }).done(function(result){
            console.log(result);

            var box_comm = document.querySelector('.box_publicacao');
            while(box_comm.firstChild){
                box_comm.firstChild.remove();
            }
            
            for (var i = 0; i < result.length; i++) {

                comentar = '<p><a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample'+ i +'" role="button" aria-expanded="false" aria-controls="collapseExample'+ i +'">Fazer um Comentário</a></p><div class="collapse" id="collapseExample'+ i +'"><div class="card card-body box-comentario"><div class="box_form"><form id="comentario" class="d-flex align-items-center"><input type="text" name="comentar" id="comentar" class="form-control"><input type="text" name="idpublicacao" id="idpublicacao" class="d-none" value="'+ result[i].IDPublicacao +'"/><input type="submit" form="comentario" class="btn btn-primary" value="Comentar"/><br><br></form></div></div></div><br>';

                ver_comentarios = '<p><a class="btn btn-primary" data-bs-toggle="collapse" href="#comentarios'+ i +'" role="button" aria-expanded="false" aria-controls="comentarios'+ i +'">Ver comentários</a></p><div class="collapse" id="comentarios'+ i +'"><div class="box_comentarios"></div></div>';

                $('.box_publicacao').prepend('<div class="box-publicacao mb-5 p-3"><div class="row"><div class="col-md-2"><div class="box-img-post"><img src="/FORUM_CODEIGNITER/assets/img/usuarios/'+ result[i].Foto +'"><br><br><b>'+ result[i].Nome +'</b></div></div><div class="col-md-10"><div class="box-content-post"><p>Por: '+ result[i].Nome +' em: '+ result[i].Data + ' ' + result[i].Hora +'</p><hr><h3>'+ result[i].Titulo +'</h3><p>'+ result[i].Conteudo +'</div><div class="box-footer-post">'+ comentar + ver_comentarios +'<a href="" class="link-like">Like<i class="bi bi-star-fill m-2"></i></a><a href="" class="link-deslike">Deslike<i class="bi bi-star m-2"></i></a></div></div></div></div>');

            }
                //recebe dados do formulário da publicação
                $("#comentario").submit(function(e) {
                    e.preventDefault();    
                    var formData = new FormData(this);

                    $.ajax({
                        url: 'http://localhost/FORUM_CODEIGNITER/public/Feed/inserirComentario',
                        type: 'POST',
                        data: formData,
                        // success: function (data) {
                        //     alert('Publicação postada com sucesso')
                        // },
                        cache: false,
                        contentType: false,
                        processData: false
                        
                    }).done(function(resultComentarios){
                            alert('Comentário postado com sucesso')
                            $('#comentar').val('');
                            $('#idpublicacao');
                            console.log(resultComentarios);
                            getComentarios(); 
                        });
                });

                

                function getComentarios() {
                    $.ajax({
                        url: 'http://localhost/FORUM_CODEIGNITER/public/Feed/selecionarComentarios/',
                        method: 'POST',
                        dataType: 'json'
                    }).done(function(resultComentarios){
                        console.log(resultComentarios);

                        var box_comm = document.querySelector('.box_comentarios');
                        while(box_comm.firstChild){
                            box_comm.firstChild.remove();
                        }
                        
                        for (var i = 0; i < resultComentarios.length; i++) {

                            $('.box_comentarios').prepend('<div class="box-publicacao mb-5 p-3"><div class="row"><div class="col-md-2"><div class="box-img-post"><img src="/FORUM_CODEIGNITER/assets/img/usuarios/'+ resultComentarios[i].Foto +'"><br><br><b>'+ resultComentarios[i].Nome +'</b></div></div><div class="col-md-10"><div class="box-content-post"><p>Por: '+ resultComentarios[i].Nome +' em: '+ result[i].Data + ' ' + resultComentarios[i].Hora +'</p><hr><p>'+ resultComentarios[i].Conteudo +'</div><hr><div class="box-footer-post"><a href="" class="link-like">Like<i class="bi bi-star-fill m-2"></i></a><a href="" class="link-deslike">Deslike<i class="bi bi-star m-2"></i></a></div></div></div></div>');

                        }
                                
                    });
                    
                }
                getComentarios();
                    
        });
        
    }
    getPublicacao();

    //recarrega a função pra exibir dados atualizados 
    //setInterval("getPublicacao()", 60000);
    //Quando carregar a página
    //$(function() {
        //Faz a primeira atualização
       // getPublicacao();
    //});




       
    //===================================================================
    
    //exibe o conteúdo das publicações ativas
    
    

    </script>
    
