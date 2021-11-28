<?php
    use App\Controllers\ValidaSessao;
    $adm = new ValidaSessao();
    $adm->validarPermissaoAdm();
?>

<br>
<div class="container">
    <br />
    <div class="d-flex flex-wrap">
        <a href="/FORUM_CODEIGNITER/public/administrador/index" class="button-back p-3 my-3">VOLTAR</a>
    </div>
    <br />
    <h1>GERAR SENHA PARA USUÁRIO</h1>
<?php
 

 $inputView = [
     'class' => 'form-control',
     'readonly' => 'readonly'
 ];

 $input = [
    'class' => 'form-control',
    'required' => 'required',
    'placeholder' => 'Por padrão utilize: 123456'
 ];

helper('form');
    echo form_open('Administrador/senhaGerada');
        echo form_label('ID');
        echo '<br>';
        echo form_input('ID',$usuario['ID'],  $inputView);
        echo '<br>';

        echo form_label('Nome usuário');
        echo '<br>';
        echo form_input('nome', $usuario['Nome'],  $inputView);
        echo '<br>';

        echo form_label('RM usuário');
        echo '<br>';
        echo form_input('rm', $usuario['RM'],  $inputView);
        echo '<br>';

        echo form_label('E-mail usuário');
        echo '<br>';
        echo form_input('email', $usuario['Email'],  $inputView);
        echo '<br>';

        echo form_label('Senha do usuário');
        echo '<br>';
        echo form_input('senha','', $input);
        echo '<br>';

        echo '<div class="text-center">';
            echo form_submit('mysubmit', 'Gerar senha', 'class="button-submit py-3 my-3"');
        echo '</div>';
    echo form_close();

?>
</div>
<!-- end container -->
<br><br><br><br><br><br>