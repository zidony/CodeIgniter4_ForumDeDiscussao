<?php 
	use App\Controllers\ValidaSessao;
	$adm = new ValidaSessao();
	$adm->validarPermissaoAdm();
?>

<br>
<div class="container">
    <h1>PAINEL ADMINSITRATIVO</h1>
    <br><br>
    <a href="../" class="button-back p-3 my-3">VOLTAR A INDEX</a>
    <br><br><br><br>
    <div class="row">
        <div class="col-md-4">
            <a href="../usuario/registraUsuario" class="box-painel">
                <div class="box">
                    <i class="bi bi-person-fill"></i> REGISTRAR<br> UM USUÁRIO
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="categoria" class="box-painel">
                <div class="box">
                    <i class="bi bi-bookmark-fill"></i> REGISTRAR<br>  CATEGORIA
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="rm" class="box-painel">
                <div class="box">
                    <i class="bi bi-people-fill"></i> REGISTRAR<br>  RMs DE ALUNOS NOVOS
                </div>
            </a>
        </div>
    </div>
    <!-- end row -->
</div>
<br><br><br><br>
	


