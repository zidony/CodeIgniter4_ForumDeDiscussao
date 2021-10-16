<main>
    <div class="container mt-5">
        <!-- instancias -->
        <?php
            use App\Controllers\Home;
            use App\Controllers\ValidaSessao;
            $objHome = new Home();
            $objValida = new ValidaSessao();
        ?>
            
        <div class="row">
            <div class="col-md-12 col-lg-8">
                <div class="box-categorias">
                    <h2 id="pesquise">Pesquiser ou filtre pelo nome do curso</h2>
                    <input type="text" class="form-control">
                    <br><br>
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
                                        <div class="col-sm-12 col-md-4 col-xl-3 box-img-categoria">
                                            <img src="/FORUM_CODEIGNITER/assets/img/categorias/<?php echo $data[$key]['Imagem']; ?>">
                                        </div>

                                        <div class="col-sm-12 col-md-8 col-xl-9 box-content-categoria">
                                            <h3 title="<?php echo $data[$key]['Titulo']; ?>" class="pt-3"><?php echo $data[$key]['Titulo']; ?></h3>
                                            <hr class="linha-categorias">
                                            <p><?php echo $data[$key]['Conteudo']; ?></p>
                                            <a href="feed/curso/<?php echo $data[$key]['LinkAmigavel'] ?>/<?php echo $data[$key]['ID'] ?>" class="btn-categoria">Acessar</a>
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
            <div class="col-md-12 col-lg-4">
                <div class="box-referencias">
                    <?php 
                        $objValida->mostraBotaoLogar();
                    ?>
                </div>
            </div>
            <!-- fim col -->
        </div>
        <!-- fim row -->
        <br><hr>

        
    </div>
    <!-- fim container -->
</main>
    
