<?php 
	use App\Controllers\ValidaSessao;
	$adm = new ValidaSessao();
	$adm->validarPermissaoAdm();
?>
		
		<div class="container">
			<br />
			<br />
			<div class="d-flex flex-wrap">
				<a href="/FORUM_CODEIGNITER/public/administrador/usuarios" class="button-back p-3 my-3">VOLTAR</a>
			</div>
			

			<br />
			<h1>USUARIOS REGISTRADOS NO SISTEMA</h1><br />
			<div class="form-group">
				<div class="input-group">
					<input type="text" name="search_text" id="search_text" placeholder="Pesquise por Nome, Sobrenome e RM" class="form-control" />
				</div>
			</div>
			<br />
			<div id="result"></div>
		</div>
		<div style="clear:both"></div>
		<br />
		<br />
		<br />
		<br />
		<script>
			$(document).ready(function(){

				load_data();

				function load_data(query)
				{
					$.ajax({
						url:"/FORUM_CODEIGNITER/public/administrador/fetch",
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
			});
		</script>



