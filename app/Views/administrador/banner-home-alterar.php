<?php

    use App\Controllers\ValidaSessao;
    $adm = new ValidaSessao();
    $adm->validarPermissaoAdm();

helper('form');
    echo form_open('Administrador/banner_home_alterando');
        echo form_label('ID');
        echo '<br>';
        echo form_input('id',$alterar[0]['ID'], 'readonly');
        echo '<br><br>';

        echo form_label('Título');
        echo '<br>';
        echo form_input('titulo',$alterar[0]['Titulo'], 'required');
        echo '<br><br>';

        echo form_label('Subtitulo');
        echo '<br>';
        echo form_input('subtitulo',$alterar[0]['Subtitulo'], 'required');
        echo '<br><br>';

        echo form_label('Link Regras');
        echo '<br>';
        echo form_input('linkRegras', $alterar[0]['LinkRegras'], 'required');
        echo '<br><br>';

        echo form_label('Link Guias');
        echo '<br>';
        echo form_input('linkGuias', $alterar[0]['LinkGuias'], 'required');
        echo '<br><br>';

        echo form_label('Link Ajuda');
        echo '<br>';
        echo form_input('linkAjuda', $alterar[0]['LinkAjuda'], 'required');
        echo '<br><br>';

        echo form_submit('mysubmit', 'Alterar Banner Home', 'class="btn btn-primary"');
    echo form_close();

    echo '<br><br>';
    echo 'Alterar imagem banner';
    echo form_open('Administrador/banner_home_alterando_imagem');
        echo form_label('ID');
        echo '<br>';
        echo form_input('id',$alterar[0]['ID'], 'readonly');
        echo '<br><br>';

        echo form_label('Imagem');
        echo '<br>';
        echo form_upload('img', '', 'required');
        echo '<br><br>';

        echo form_submit('mysubmit', 'Alterar imagem banner', 'class="btn btn-primary"');
    echo form_close();

    //desativar banner rotativo 'futuro'
    // echo '<br><br>';
    // echo 'Alterar imagem banner';
    // echo form_open('Administrador/banner_home_alterando_imagem');
    //     echo form_label('ID');
    //     echo '<br>';
    //     echo form_input('id',$alterar[0]['ID'], 'readonly');
    //     echo '<br><br>';

    //     echo form_label('Imagem');
    //     echo '<br>';
    //     echo form_upload('img', '', 'required');
    //     echo '<br><br>';

    //     echo form_submit('mysubmit', 'Alterar imagem banner', 'class="btn btn-primary"');
    // echo form_close();

?>