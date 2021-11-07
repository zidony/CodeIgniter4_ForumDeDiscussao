<link rel="stylesheet" href="/FORUM_CODEIGNITER/css/style-publicacoes.css">
<title>card</title>
</head>
<body>
<br><br><br><br><br><br>

<div class="container box-container">

    <div class="box-publicacao mt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="header-publicacao p-3">
                    <div class="d-flex">
                        <img src="/FORUM_CODEIGNITER/assets/img/usuarios/wesley.jpg" alt="" class="img-perfil">

                        <div class="text-left mx-2">
                            <b>Wesley</b>
                            <br>
                            <p>30/10/2021 17:00</p>
                        </div>
                    </div>
                    <div class="">
                        <p>Ação para adm<br>Desativar post</p>
                    </div>
                    
                </div>
                
            </div>
            <div class="col-md-12">
                <div class="box-content-post">
                    <hr>
                    <h3 class="px-3">Título da publicação</h3>
                    <p class="px-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis neque asperiores iusto maxime maiores, placeat libero ut explicabo provident velit iste tenetur, vero labore non odio, corrupti sit? Sequi, ab?</p>
                    <div class="text-center box-img-publicacao">
                        <a href="/FORUM_CODEIGNITER/assets/img/usuarios/wesley.jpg" target="_blank"><img src="/FORUM_CODEIGNITER/assets/img/categorias/adm.png"></a>
                    </div>
                </div>
                <hr>
                <div class="box-footer-publicacao">
                    <a href="" class="btn-footer-publicacao"><i class="bi bi-chat-right mx-2 icon-comment"></i>Comentar</a>
                    <a href="" class="btn-footer-publicacao"><i class="bi bi-chat-right-text mx-2 icon-comment"></i>Ver comentários</a>
                </div>
            </div>
        </div>
        <!-- fim row -->
    </div>
</div>

<br><br><br><br><br><br>



<a class="btn-footer-publicacao" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <i class="bi bi-chat-right mx-2 icon-comment"></i>
                        Comentar
                    </a>
                    <div class="collapse" id="collapseExample">
                        <div class="card card-body box-comentario">
                            <div class="box_form">
                                <form id="comentario" class="d-flex align-items-center">
                                    <input type="text" name="comentar" id="comentar" class="form-control">
                                    <input type="text" name="idpublicacao" id="idpublicacao" class="d-none" value="+ result[i].IDPublicacao"/>
                                    <input type="submit" form="comentario" class="btn btn-primary" value="Comentar"/>
                                    <br><br>
                                </form>
                            </div>
                        </div>
                    </div>
                    <br>;




                    <br><br><br><br><br><br>

                    <div class="container box-container">
                        <div class="box-publicacao mt-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="header-comentario p-3">
                                        <div class="text-center">
                                            <img src="/FORUM_CODEIGNITER/assets/img/usuarios/wesley.jpg" alt="" class="img-perfil">
                                            <br>
                                            <b class="p-2">Wesley</b>  
                                        </div>
                                        <p class="p-4">Lorem ipsum dolor sit?</p>
                                    </div>  
                                    <div class="text-end">
                                        <p>Data e hora comentado: 30/10/2021 17:00</p>
                                    </div>
                                </div>
                            </div>
                            <!-- fim row -->
                        </div>
                    </div>

                    <br><br><br><br><br><br>



<!-- comentarios -->
<!-- <p><a class="btn btn-primary" data-bs-toggle="collapse" href="#comentarios" role="button" aria-expanded="false" aria-controls="comentarios">Ver comentários</a></p><div class="collapse" id="comentarios"><div class="card card-body"><div class="box_comentarios"></div></div></div>
 -->
