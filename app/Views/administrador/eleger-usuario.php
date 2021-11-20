<?php
    use App\Controllers\ValidaSessao;
    $adm = new ValidaSessao();
    $adm->validarPermissaoAdm();
?>

<br>
<div class="container">
    <br />
    <div class="d-flex flex-wrap">
        <a href="/FORUM_CODEIGNITER/public/administrador/usuarios" class="button-back p-3 my-3">VOLTAR</a>
    </div>
    <br />
    <h1>ELEGER USUÁRIO PARA UM NOVO NÍVEL</h1>
<?php
 

 $inputView = [
     'class' => 'form-control',
     'readonly' => 'readonly'
 ];

 $input = [
    'class' => 'form-control',
    'required' => 'required'
 ];

 $inputdrop = [
    'class' => 'form-control w-25',
    'required' => 'required'
 ];

 if ($usuario['Nivel'] == 1)
 {
    $nivelUsuario = 'Usuário';
 }
 else if ($usuario['Nivel'] == 2)
 {
    $nivelUsuario = 'Moderador';
 }
 else if ($usuario['Nivel'] == 3)
 {
    $nivelUsuario = 'Administrador';
 }

$drop = [
    $usuario['Nivel'] => $nivelUsuario,
    1 => 'Usuário',
    2 => 'Moderador',
    3 => 'Administrador'
];

helper('form');
    echo form_open('Administrador/usuarioElegido');
        echo form_label('ID');
        echo '<br>';
        echo form_input('ID',$usuario['ID'],  $inputView);
        echo '<br>';

        echo form_label('Nome usuário');
        echo '<br>';
        echo form_input('Nome', $usuario['Nome'],  $inputView);
        echo '<br>';

        echo form_label('E-mail usuário');
        echo '<br>';
        echo form_input('Email', $usuario['Email'],  $inputView);
        echo '<br>';

        echo form_label('Nível do usuário');
        echo '<br>';
        echo form_dropdown('Nivel', $drop, '',  $inputdrop);
        echo '<br>';

        echo '<div class="text-center">';
            echo form_submit('mysubmit', 'Eleger usuário', 'class="button-submit py-3 my-3"');
        echo '</div>';
    echo form_close();

?>
</div>
<!-- end container -->