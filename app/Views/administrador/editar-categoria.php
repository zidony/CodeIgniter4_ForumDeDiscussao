<div class="container">
    <br><br><br>
    <h2>Editar Categoria Selecioanda</h2>
<?php
 

 $inputView = [
     'class' => 'form-control',
 ];

 $inputViewC = [
    'class' => 'form-control',
    'rows' => '2'
];


helper('form');
    echo form_open('Administrador/editarCategoria');
        echo form_input('id',$categoria['ID'],  'class="d-none"');

        echo form_label('Título');
        echo '<br>';
        echo form_input('titulo', $categoria['Titulo'],  $inputView);
        echo '<br>';

        echo form_label('Conteúdo');
        echo '<br>';
        echo form_textarea('conteudo',$categoria['Conteudo'], $inputViewC);
        echo '<br>';

        echo form_label('Link Amigavel');
        echo '<br>';
        echo form_input('link', $categoria['LinkAmigavel'],  $inputView);
        echo '<br>';

        echo '<div class="text-center">';
            echo form_submit('mysubmit', 'Alterar', 'class="button-submit py-3 my-3"');
        echo '</div>';
    echo form_close();
    echo '<br><br>';

    echo '<h2>Editar Imagem Categoria</h2>';
    helper('form');
    echo form_open_multipart('Administrador/editarImagemCategoria');
        echo form_input('id',$categoria['ID'],  'class="d-none"');

        echo form_label('Imagem');
        echo '<br>';
        echo form_upload('img[]', '', $inputView);
        echo '<br>';

        echo '<div class="text-center">';
            echo form_submit('mysubmit', 'Alterar Imagem', 'class="button-submit py-3 my-3"');
        echo '</div>';
    echo form_close();

?>
    <br><br><br><br><br><br><br><br><br>
</div>
<!-- end container -->  