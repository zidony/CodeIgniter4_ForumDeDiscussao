<?php

// echo '<pre>';
// var_dump();

    use App\Controllers\ValidaSessao;
    $adm = new ValidaSessao();
    $adm->validarPermissaoAdm();

helper('form');
    echo form_open('Administrador/criar_banner_home');
        echo form_label('Título');
        echo '<br>';
        echo form_input('titulo','', 'required');
        echo '<br><br>';

        echo form_label('Subtitulo');
        echo '<br>';
        echo form_input('subtitulo','', 'required');
        echo '<br><br>';

        echo form_label('Imagem');
        echo '<br>';
        echo form_upload('img', '', 'required');
        echo '<br><br>';

        echo form_label('Link Regras');
        echo '<br>';
        echo form_input('linkRegras', '', 'required');
        echo '<br><br>';

        echo form_label('Link Guias');
        echo '<br>';
        echo form_input('linkGuias', '', 'required');
        echo '<br><br>';

        echo form_label('Link Ajuda');
        echo '<br>';
        echo form_input('linkAjuda', '', 'required');
        echo '<br><br>';

        echo form_submit('mysubmit', 'Criar Banner Home', 'class="btn btn-primary"');
    echo form_close();


?>