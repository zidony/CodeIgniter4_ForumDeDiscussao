<?php

use App\Controllers\Usuario;
use App\Controllers\ValidaSessao;

$adm = new ValidaSessao();
$adm->validaSessao();

$imageuser = new Usuario();
$imageuser->SelectImageUser();
$foto = $imageuser->SelectImageUser();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Bootstrap Example</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>


	<div class="container">

		<center>

			<div class="card-perfil" style="width: 30%;">
				<img src="/FORUM_CODEIGNITER/assets/img/usuarios/<?php echo $foto; ?>">
				<br>
				<br>
				<?php
				echo session()->usuario;
				?>
				<br>
				<br>

				<button type="button" class="btn btn-outline-light text-primary" data-toggle="modal" data-target="#updateimage">Alterar foto de perfil</button>
				<br>
				<button type="button" class="btn btn-outline-light text-primary" data-toggle="modal" data-target="#alterarsenha">Alterar senha</button>
				<br>
				<button type="button" class="btn btn-outline-light text-primary" data-toggle="modal" data-target="#alteraruserdata">Alterar Dados do usuário</button>
			</div>
			<div class="modal fade" id="updateimage">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">

						<!-- Modal Header -->
						<div class="modal-header">
							<h4 class="modal-title">Escolha uma nova foto de perfil</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>

						<!-- Modal body -->
						<div class="modal-body">
							<?php

							helper('form');

							$formalteruserimage = [
								'id' => 'userimage',
							];

							$infoimagem = [
								'name' => 'userimage[]',
								'id'   => 'userimage',
								'class' => "form-control",
								'required' => true,
							];
							echo form_open_multipart('Usuario/UserImage', $formalteruserimage);

							echo form_label('Altere sua foto de perfil:');
							echo '<br>';

							echo form_upload($infoimagem);



							?>
						</div>

						<!-- Modal footer -->
						<div class="modal-footer">
							<?php
							echo form_submit('mysubmit', 'Concluído', 'class="btn btn-primary"');
							echo form_close();
							?>
						</div>

					</div>
				</div>
			</div>

			<div class="modal fade" id="alterarsenha">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">

						<!-- Modal Header -->
						<div class="modal-header">
							<h4 class="modal-title">Alterar senha</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>

						<!-- Modal body -->
						<div class="modal-body">
							<?php

							helper('form');

							$formalterusercode = [
								'id' => 'usercode',
							];

							$infocode = [
								'name' => 'senha',
								'id'   => 'senha',
								'type' => 'password',
								'class' => "form-control",
								'style' => "width: 50%;",
								'required' => true,
							];

							$infocode2 = [
								'name' => 'senha2',
								'id'   => 'senha2',
								'type' => 'password',
								'class' => "form-control",
								'style' => "width: 50%;",
								'required' => true,
							];

							echo form_open('Usuario/AlterCode', $formalterusercode);

							echo form_label('Digite a nova senha:');
							echo '<br>';
							echo form_input($infocode);
							echo '<br>';
							echo form_label('Confirme a senha:');
							echo '<br>';
							echo form_input($infocode2);


							?>
						</div>

						<!-- Modal footer -->
						<div class="modal-footer">
							<?php
							echo form_submit('mysubmit', 'Alterar', 'class="btn btn-primary"');
							echo form_close();
							?>
						</div>

					</div>
				</div>
			</div>

			<div class="modal fade" id="alteraruserdata">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">

						<!-- Modal Header -->
						<div class="modal-header">
							<h4 class="modal-title">Alterar Dados</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>

						<!-- Modal body -->
						<div class="modal-body">
							<?php

							helper('form');

							$formalteruserdata = [
								'id' => 'userdata',
							];

							$infonome = [
								'name' => 'alternome',
								'id'   => 'alternome',
								'class' => "form-control",
								'style' => "width: 50%;",
								'required' => true,
							];

							$infosobrenome = [
								'name' => 'altersobrenome',
								'id'   => 'altersobrenome',
								'class' => "form-control",
								'style' => "width: 50%;",
								'required' => true,
							];

							$infodate = [
								'name' => 'alterdate',
								'id'   => 'alterdate',
								'type' => 'date',
								'class' => "form-control",
								'style' => "width: 50%;",
								'required' => true,
							];

							echo form_open('Usuario/AlterUserData', $formalteruserdata);

							echo form_label('Alterar nome:');
							echo '<br>';
							echo form_input($infonome);
							echo '<br>';
							echo form_label('Alterar sobrenome:');
							echo '<br>';
							echo form_input($infosobrenome);
							echo '<br>';
							echo form_label('Alterar a data de nascimento:');
							echo '<br>';
							echo form_input($infodate);
							


							?>
						</div>

						<!-- Modal footer -->
						<div class="modal-footer">
							<?php
							echo form_submit('mysubmit', 'Alterar', 'class="btn btn-primary"');
							echo form_close();
							?>
						</div>

					</div>
				</div>
			</div>




		</center>
	</div>
</body>

</html>