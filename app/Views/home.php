
<main>
    <div class="container-fluid mt-5">
        <!-- instancias -->
        <?php
            use App\Controllers\Home;
            use App\Controllers\ValidaSessao;
            $objHome = new Home();
            $objValida = new ValidaSessao();
        ?>
            
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-8">
                <div class="box-categorias">
                    <h2>Acesse agora as discussões de um ou mais cursos.</h2>
                    <!-- instancia as categorias -->
                    <?php
                        $objHome->consulta_categoria();
                        $data = $objHome->consulta_categoria();
                        foreach ($data as $key => $value) {
                            if ($data[$key]['Ativo'] == 1)
                            { ?>
                                <div class="my-3 cards-categoria">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-3 col-xl-3 box-img-categoria">
                                            <img src="/FORUM_CODEIGNITER/assets/img/categorias/<?php echo $data[$key]['Imagem']; ?>">
                                        </div>

                                        <div class="col-sm-12 col-md-9 col-xl-9 box-content-categoria">
                                            <h3 title="<?php echo $data[$key]['Titulo']; ?>" class="pt-3"><?php echo $data[$key]['Titulo']; ?></h3>
                                            <hr class="linha-categorias">
                                            <p><?php echo $data[$key]['Conteudo']; ?></p>
                                            <!-- <form action="">

                                            </form> -->
                                            <a href="feed/publicacoes/<?php echo $data[$key]['LinkAmigavel'] ?>/<?php echo $data[$key]['ID'] ?>" class="btn-categoria">Acessar</a>
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
            <div class="col-md-12 col-lg-12 col-xl-4">
                <div class="box-referencias">
                    <?php 
                        $objValida->mostraBotaoLogar();
                        
                    ?>
                    <div class="form-group">
                        <h2 class="text-center">Publicações recentes</h2>
                        <div class="input-group">
                            <input type="text" name="search_text" id="search_text" placeholder="Pesquise..." class="form-control" />
                        </div>
                    </div>
                    <br />
                    <div id="result">

                    </div>
                </div>
                <div style="clear:both"></div>
                </div>
            </div>
            <!-- fim col -->
        </div>
        <!-- fim row -->
        <br><hr>

        
    </div>
    <!-- fim container -->
</main>

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
   
    
    $(document).ready(function(){
        load_data();
            
        function load_data(query)
        {
            $.ajax({
                url:"/FORUM_CODEIGNITER/public/Home/fetch_publicacoes",
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
            {
                load_data(search);
            }
            else
            {
                load_data();
                
            }
        });

        setInterval(function load_data() {
        
            load_data();
            
            function load_data(query)
            {
                $.ajax({
                    url:"/FORUM_CODEIGNITER/public/Home/fetch_publicacoes",
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
                {
                    load_data(search);
                }
                else
                {
                    load_data();
                    
                }
            });
        }, 60000)
    });

    $(document).ready(function(){
        function verificar_privacidade()
        {
            $.ajax({
                url:"/FORUM_CODEIGNITER/public/ValidaSessao/verificarPrivacidade/" + <?php echo json_encode(session()->id) ?> + "/" + <?php echo json_encode(session()->privacidade) ?>,
                method: 'POST',
                dataType: 'json'
                }).done(function(teste){
                    console.log(teste);
                    // var box_comment = document.querySelector('.resultadoPrivacidade');
                    // while(box_comment.firstChild){
                    //     box_comment.firstChild.remove();
                    // }
                    for (var i = 0; i < teste.length; i++) {

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
                                '<input type="hidden" id="idusuario" name="idusuario" value="'+ teste[i].ID +'">' +
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


