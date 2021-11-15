<div class="container">
<?php
    //decodifica o array caso seja stdClass
    $comentarioSelecionado = json_decode(json_encode($comentario), true);
    // echo '<pre>';
    // var_dump($comentarioSelecionado);



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

   
    echo '<br><br><h2>Alterar conteúdo do comentário selecionado</h2>';
    helper('form');
    echo form_open_multipart('Feed/editarComentario');

        echo form_input('idcomentario', $comentarioSelecionado[0]['IDConteudoComentario'], 'class="d-none"');

        echo form_label('Conteúdo do comentário');
        echo '<br>';
        echo form_textarea('conteudo', $comentarioSelecionado[0]['Conteudo'], $inputConteudo,);
        echo '<br><br>';

        echo '<div class="text-center">';
        echo form_submit('mysubmit', 'Editar comentário', 'class="button-submit"');
        echo '</div><br>';
    echo form_close();

    echo '<hr><h2>Alterar imagem do comentário</h2>';
    helper('form');
    echo form_open_multipart('Feed/editarImagemComentario');

        echo form_input('idcomentario', $comentarioSelecionado[0]['ID'], 'class="d-none"');
        echo form_input('idimagem', $comentarioSelecionado[0]['IDImagem'], 'class="d-none"');
        
        echo form_upload('img[]', $comentarioSelecionado[0]['Imagem'], $inputImg);
        echo '<br><br>';

        echo '<div class="text-center">';
        echo form_submit('mysubmit', 'Alterar imagem do comentário', 'class="button-submit"');
        echo '</div><br><br><br><br><br><br><br><br>';
    echo form_close();

    


?>
</div>
<!-- fim container -->