<?php
    use App\Controllers\ValidaSessao;
    $adm = new ValidaSessao();
    $adm->validarPermissaoAdm();
?>
    <link rel="stylesheet" href="/FORUM_CODEIGNITER/css/style-tables.css">
    <title>Categorias registradas</title>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" /> -->
</head>
<body>
    <div class="container">
        <br />
        <div class="d-flex flex-wrap">
            <a href="index" class="button-back p-3 my-3">VOLTAR</a>
            <a href="../rm" class="button-painel p-3 my-3">RMs</a>
        </div>
        <br />
        <h1>ALTERAR DADOS DO RM SELECIONADO</h1>
<div class="container">
<?php

$input = [
    'class' => 'form-control',
    'required' => 'required'
];


$inputConteudo = [
    'class' => 'form-control',
    'required' => 'required',
    'maxlength' => '65',
    'rows' => '2'
];

helper('form');
echo form_open('Administrador/criar_categoria');
    echo form_label('ID');
    echo '<br>';
    echo form_input('id', $listaRM['ID'], $input);
    echo '<br><br>';

    echo form_label('RM');
    echo '<br>';
    echo form_input('rm', $listaRM['RM'], $input);
    echo '<br><br>';

    echo form_label('Nome');
    echo '<br>';
    echo form_input('nome', $listaRM['Nome'], $inputConteudo);
    echo '<br><br>';

    echo form_label('E-mail');
    echo '<br>';
    echo form_input('email', $listaRM['Email'], $input);
    echo '<br><br>';

    echo '<div class="text-center">';
    echo form_submit('mysubmit', 'Alterar dados do RM selecionado', 'class="button-submit py-3 my-3"');
    echo '</div>';
echo form_close();


?>

</div>