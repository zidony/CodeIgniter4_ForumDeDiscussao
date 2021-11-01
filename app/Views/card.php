<link rel="stylesheet" href="/FORUM_CODEIGNITER/css/style-publicacoes.css">
<title>card</title>
</head>
<body>


<div class="container">
    <div class="box-publicacao mt-3 p-3">
        <div class="row">
            <div class="col-md-2">
                <div class="box-img-post">
                    <img src="/FORUM_CODEIGNITER/assets/img/usuarios/wesley.jpg">
                    <br><br>
                    <b>Wesley</b>
                </div>
            </div>
            <div class="col-md-10">
                <div class="box-content-post">
                    <p>Por: Wesley em: 30/10/2021 17:00</p>
                    <hr>
                    <h3>Título da publicação</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis neque asperiores iusto maxime maiores, placeat libero ut explicabo provident velit iste tenetur, vero labore non odio, corrupti sit? Sequi, ab?</p>
                    <a href="/FORUM_CODEIGNITER/assets/img/usuarios/wesley.jpg" target="_blank"><img src="/FORUM_CODEIGNITER/assets/img/usuarios/wesley.jpg"></a>
                </div>
                <hr>
                <div class="box-footer-post">
                    <a href="" class="link-like">Like<i class="bi bi-star-fill m-2"></i></a>
                    <a href="" class="link-deslike">Deslike<i class="bi bi-star m-2"></i></a>
                </div>
            </div>
        </div>
        <!-- fim row -->
    </div>
</div>




<div class="box-comentario"><p><a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample[]" role="button" aria-expanded="false" aria-controls="collapseExample[]">Comentar</a></p><div class="collapse" id="collapseExample[]"><div class="card card-body box-comentario">
    <div class="box_form">
        <h1>Deixe seu Comentário:</h1>
<form id="form2">
    <label for="comentario">Conteúdo</label><br>
    <textarea name="comentario" rows="5" id="comentario" class="form-control" required></textarea><br><br>
    
    <input type="file" class="form-control" name="img" id="img" required/><br><br>
    
    <input type="text" name="idpublicacao" id="idpublicacao" class="d-none" value="'+ result[i].ID +'"/>
    
    <input type="submit" form="form2" class="btn btn-primary" value="Publicar"/><br><br>
</form></div></div></div></div>

<div class="box_comentarios"></div>


<!-- comentarios -->
<p><a class="btn btn-primary" data-bs-toggle="collapse" href="#comentarios" role="button" aria-expanded="false" aria-controls="comentarios">Ver comentários</a></p><div class="collapse" id="comentarios"><div class="card card-body"><div class="box_comentarios"></div></div></div>

