<?php

// echo '<pre>';
// var_dump();

    use App\Controllers\ValidaSessao;
    $adm = new ValidaSessao();
    $adm->validarPermissaoAdm();

helper('form');
    echo form_open('Administrador/criar_categoria');
        echo form_label('Título');
        echo '<br>';
        echo form_input('titulo','', 'required');
        echo '<br><br>';

        echo form_label('Imagem');
        echo '<br>';
        echo form_upload('img', '', 'required');
        echo '<br><br>';

        echo form_label('Conteúdo');
        echo '<br>';
        echo form_input('conteudo', '', 'required');
        echo '<br><br>';

        echo form_label('Link amigável');
        echo '<br>';
        echo form_input('link', '', 'required');
        echo '<br><br>';


        echo form_submit('mysubmit', 'Criar categoria', 'class="btn btn-primary"');
    echo form_close();


?>