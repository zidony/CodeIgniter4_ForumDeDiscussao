
    <title>Página inicial - Fórum</title>
</head>
<body>
    <main>
        <div class="container mt-5">
            <!-- instancias -->
            <?php
                use App\Controllers\Home;
                $obj = new Home();
            ?>
                
            <div class="row">
                <div class="col-md-12 col-lg-8">
                    <div class="box-categorias">
                        <h2>Pesquiser ou filtre pelo nome do curso</h2>
                        <input type="text" class="form-control">
                        <br><br>
                        <h2>Acesse agora as discussões de um ou mais cursos.</h2>
                        <!-- instancia as categorias -->
                        <?php
                            $obj->consulta_categoria();
                            $data = $obj->consulta_categoria();
                            foreach ($data as $key => $value) {
                                if ($data[$key]['Ativo'] == 1)
                                { ?>
                                    <div class="my-3 cards-categoria">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-4 col-xl-3 box-img-categoria">
                                                <img src="/FORUM_CODEIGNITER/assets/img/categorias/<?php echo $data[$key]['Imagem']; ?>" style="width: 170px">
                                            </div>

                                            <div class="col-sm-12 col-md-8 col-xl-9 box-content-categoria">
                                                <h3 title="<?php echo $data[$key]['Titulo']; ?>" class="pt-3"><?php echo $data[$key]['Titulo']; ?></h3>
                                                <hr>
                                                <p><?php echo $data[$key]['Conteudo']; ?></p>
                                                <a href="feed/<?php $data[$key]['LinkAmigavel'] ?>" class="btn-categoria">Acessar</a>
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
                    conteúdo lateral, utilizado para consulta de publicações feitas
                </div>
                <!-- fim col -->
            </div>
            <!-- fim row -->
            <br><hr>

            
        </div>
        <!-- fim container -->
    </main>
    
