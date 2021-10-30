<div class="container">
<br><br>
    <h1>Sou a página do curso</h1>
    <br><br>


        <div class="box_form">
			<h1>Deixe sua Publicação:</h1>
			<form id="form1">
				<label for="name">Título</label><br>
				<input type="text" name="name" id="name" class="form-control" required/><br><br>

				<label for="comment">Conteúdo</label><br>
				<textarea name="comment" rows="5" id="comment" class="form-control" required></textarea><br><br>

                <input type="file" class="form-control" name="img" id="img" required/><br><br>

				<input type="submit" form="form1" class="btn btn-primary" value="Enviar Comentário"/><br><br>
                <!-- esse cara serve pra receber uma váriavel criada lá no Fedd/publicacoes, chamada categoria -->
                <input type="text" name="categoria" id="categoria" class="d-none" value="<?php echo $idCategoria; ?>"/><br><br>
			</form>
		</div>
		<div class="box_comment">
			
		</div>
        <br><br><br>
	</section>
	
</div>

	<script>
        $('#form1').submit(function(e){
    e.preventDefault();

    var u_name = $('#name').val();
    var u_comment = $('#comment').val();
    var u_img = $('#img').val();
    var u_categoria = $('#categoria').val();

    // if (u_name == '')
    // {
    //     alert('Precisa preencher esse campo');
    //     exit();
    // }

    //console.log(u_name, u_comment);
    $.ajax({
        url: 'http://localhost/FORUM_CODEIGNITER/public/Feed/inserir',
        method: 'POST',
        data: {name: u_name, comment:u_comment, categoria: u_categoria, img: u_img},
        dataType: 'json'
    }).done(function(result){
        $('#name').val('');
        $('#comment').val('');
        $('#img').val('');
        $('#categoria').val('');
        console.log(result);
        getComments();
    });
});

function getComments() {
    $.ajax({
        url: 'http://localhost/FORUM_CODEIGNITER/public/Feed/selecionar/',
        method: 'GET',
        dataType: 'json'
    }).done(function(result){
        console.log(result);

        var box_comm = document.querySelector('.box_comment');
                while(box_comm.firstChild){
                    box_comm.firstChild.remove();
                }

        for (var i = 0; i < result.length; i++) {

            $('.box_comment').prepend('<div class="box-publicacao mb-5 p-3"><div class="row"><div class="col-md-2"><div class="box-img-post"><img src="/FORUM_CODEIGNITER/assets/img/usuarios/'+ result[i].Foto +'"><br><br><b>'+ result[i].Nome +'</b></div></div><div class="col-md-10"><div class="box-content-post"><p>Por: '+ result[i].Nome +' em: '+ result[i].Data + ' ' + result[i].Hora +'</p><hr><h3>'+ result[i].Titulo +'</h3><p>'+ result[i].Conteudo +'</div><hr><div class="box-footer-post"><a href="" class="btn btn-primary mx-3">Comentar</a><a href="" class="link-like">Like<i class="bi bi-star-fill m-2"></i></a><a href="" class="link-deslike">Deslike<i class="bi bi-star m-2"></i></a></div></div></div></div>');

            // $('.box_comment').prepend('<div class="card card-body my-2"><b>'+ result[i].ID +'</b><h1>' + result[i].Titulo + '</h1><p>' + result[i].Conteudo + '</p><a href="">Comentar</a><a href="">Like</a><a href="">Deslike</a></div>');

            // <img src="/FORUM_CODEIGNITER/assets/img/usuarios/'+ result[i].Foto +'">
                // '<div class="card card-body my-2"><b>'+ result[i].ID +'</b><h1>' + result[i].Titulo + '</h1><p>' + result[i].Conteudo + '</p><a href="">Comentar</a><a href="">Like</a><a href="">Deslike</a></div>');
        }
    });
}

getComments();
    </script>
    
