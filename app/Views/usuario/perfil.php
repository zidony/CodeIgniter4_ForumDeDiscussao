<?php
use App\Controllers\ValidaSessao;
$validar = new ValidaSessao();
$validar->validaSessaoPerfil($usuario['ID']);
?>


	<div class="container">


			<div class="card-perfil">
				<img src="/FORUM_CODEIGNITER/assets/img/usuarios/<?php echo $usuario['Foto']; ?>">
				<br>
				<br>
				<?php
					echo $usuario['Nome'].' '.$usuario['Sobrenome'];
					echo '<br><br>';

					echo '<h4 class="">Escolha uma nova foto de perfil</h4>';
					helper('form');
					echo form_open_multipart('Usuario/alterarImagemUsuario');
					echo form_label('ID:');
						echo '<br>';
						echo form_input('id', $usuario['ID'], 'class="d-none" readonly');
						echo '<br>';
						echo form_label('Altere sua foto de perfil:');
						echo '<br>';
						echo form_upload('image[]', '', 'class="form-control"');
						echo form_submit('mysubmit', 'Concluído', 'class="btn btn-primary"');
					echo form_close();
					echo '<br><br><br>';
					
					//==========================================================================

					echo '<h4 class="">Alterar senha</h4>';
					helper('form');
					echo form_open('Usuario/alterarSenhaUsuario');
						echo form_label('ID:');
						echo '<br>';
						echo form_input('id', $usuario['ID'], 'class="d-none" readonly');
						echo '<br>';
						echo form_label('Digite a nova senha:');
						echo '<br>';
						echo form_input('senha', '', 'class="form-control w-50"');
						echo '<br>';
						echo form_label('Confirme a senha:');
						echo '<br>';
						echo form_input('senha2', '', 'class="form-control w-50"');
						echo form_submit('mysubmit', 'Alterar', 'class="btn btn-primary"');
					echo form_close();
					echo '<br><br><br>';

					//==========================================================================

					echo '<h4 class="modal-title">Alterar Dados</h4>';
					helper('form');
					echo form_open('Usuario/alterarDadosUsuario');
						echo form_label('ID:');
						echo '<br>';
						echo form_input('id', $usuario['ID'], 'class="d-none" readonly');
						echo '<br>';
						echo form_label('Alterar nome:');
						echo '<br>';
						echo form_input('nome', $usuario['Nome'], 'class="form-control w-50"');
						echo '<br>';
						echo form_label('Alterar sobrenome:');
						echo '<br>';
						echo form_input('sobrenome', $usuario['Sobrenome'], 'class="form-control w-50"');
						echo '<br>';
						echo form_label('Alterar a data de nascimento:');
						echo '<br>';
						echo form_input('data', $usuario['DataNascimento'], 'class="form-control w-50"', 'date');

						echo form_submit('mysubmit', 'Alterar', 'class="btn btn-primary"');
					echo form_close();

				?>
			</div>
		
	</div>
</body>

</html>