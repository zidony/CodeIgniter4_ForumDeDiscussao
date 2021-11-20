
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


</script>
    
