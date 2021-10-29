<div class="container">

    <h1>Sou a página do curso</h1>
    <br><br>


    <div class="box_form">
			<h1>Deixe sua Publicação:</h1>
			<form id="form1">
				<label for="name">Título</label><br>
				<input type="text" name="name" id="name" class="form-control" required/><br><br>
				<label for="comment">Comentário</label><br>
				<textarea name="comment" id="comment" class="form-control" required></textarea><br><br>
				<input type="submit" form="form1" class="btn btn-primary" value="Enviar Comentário"/><br><br>
                <!-- esse cara serve pra receber uma váriavel criada lá no Fedd/publicacoes, chamada categoria -->
                <input type="text" name="categoria" id="categoria" class="d-none"/><br><br>
			</form>
		</div>
		<div class="box_comment">
			
		</div>
	</section>
	
</div>

<!-- <script src="assets/js/jQuery/jquery-3.5.1.min.js"></script> -->
	<script>
        $('#form1').submit(function(e){
    e.preventDefault();

    var u_name = $('#name').val();
    var u_comment = $('#comment').val();
    var u_categoria = $('#categoria').val();

    if (u_name == '')
    {
        alert('Precisa preencher esse campo');
        exit();
    }

    //console.log(u_name, u_comment);
    $.ajax({
        url: 'http://localhost/FORUM_CODEIGNITER/public/Feed/inserir',
        method: 'POST',
        data: {name: u_name, comment:u_comment, categoria: u_categoria},
        dataType: 'json'
    }).done(function(result){
        $('#name').val('');
        $('#comment').val('');
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
            $('.box_comment').prepend(
                '<div class="card card-body my-2"><b>'+ result[i].ID +'</b><h1>' + result[i].Titulo + '</h1><p>' + result[i].Conteudo + '</p><a href="">Comentar</a><a href="">Like</a><a href="">Deslike</a></div>');
        }
    });
}

getComments();
    </script>
    
