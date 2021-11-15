<div class="container">
<?php
    //decodifica o array caso seja stdClass
    $publicacaoSelecionada = json_decode(json_encode($publicacao), true);
    // echo '<pre>';
    // var_dump($publicacaoSelecionada);



    $inputImg = [
        'class' => 'form-control',
    ];

    $input = [
        'class' => 'form-control',
        'required' => 'required'
    ];

    $inputConteudo = [
        'class' => 'form-control',
        'required' => 'required',
        'rows' => '2'
    ];

   
    echo '<br><br><h2>Alterar conteúdo da publicação selecionada</h2>';
    helper('form');
    echo form_open_multipart('Feed/editarPublicacao');

        echo form_input('idpublicacao', $publicacaoSelecionada[0]['ID'], 'class="d-none"');
        echo form_input('idconteudo', $publicacaoSelecionada[0]['IDConteudo'], 'class="d-none"');

        echo form_label('Título da publicação');
        echo '<br>';
        echo form_input('titulo', $publicacaoSelecionada[0]['Titulo'], $input);
        echo '<br><br>';

        echo form_label('Conteúdo da publicação');
        echo '<br>';
        echo form_textarea('conteudo', $publicacaoSelecionada[0]['Conteudo'], $inputConteudo,);
        echo '<br><br>';

        echo '<div class="text-center">';
        echo form_submit('mysubmit', 'Editar publicação', 'class="button-submit"');
        echo '</div><br>';
    echo form_close();

    echo '<hr><h2>Alterar imagem da publicação</h2>';
    helper('form');
    echo form_open_multipart('Feed/editarImagemPublicacao');

        echo form_input('idpublicacao', $publicacaoSelecionada[0]['ID'], 'class="d-none"');
        echo form_input('idimagem', $publicacaoSelecionada[0]['IDImagem'], 'class="d-none"');
        
        echo form_upload('img[]', $publicacaoSelecionada[0]['Imagem'], $inputImg);
        echo '<br><br>';

        echo '<div class="text-center">';
        echo form_submit('mysubmit', 'Alterar imagem publicação', 'class="button-submit"');
        echo '</div><br><br><br><br>';
    echo form_close();

    


?>
</div>
<!-- fim container -->