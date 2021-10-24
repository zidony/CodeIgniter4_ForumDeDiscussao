<?php 
	use App\Controllers\ValidaSessao;
	$adm = new ValidaSessao();
	$adm->validarPermissaoAdm();
?>
	<link rel="stylesheet" href="/FORUM_CODEIGNITER/css/style-tables.css">
	<title>Painel administrativo</title>

	</head>
	<body>
		<br>
		<div class="container">
            <h1>PAINEL ADMINSITRATIVO</h1>
            <BR>
            <div class="d-flex flex-wrap">
                <a href="../" class="button-back p-3 my-3">VOLTAR A INDEX</a>
                <a href="../usuario/registraUsuario" class="button-painel p-3 my-3">REGISTRAR UM USUÁRIO</a>
                <a href="usuarios" class="button-painel p-3 my-3">VER USUÁRIOS REGISTRADOS</a>
                <a href="categoria" class="button-painel p-3 my-3">REGISTRAR UMA CATEGORIA</a>
                <a href="categoria" class="button-painel p-3 my-3">VER CATEGORIAS REGISTRADAS</a>
				<a href="rm" class="button-painel p-3 my-3">INSERIR RMs DE ALUNOS NOVOS</a>
            </div>
		</div>
	


