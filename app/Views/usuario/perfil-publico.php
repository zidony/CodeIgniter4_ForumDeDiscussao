
<?php

// echo '<pre>';
// var_dump($usuario);

var_dump($usuario['ID']);
var_dump($usuario['Nome']);
var_dump($usuario['Sobrenome']);
var_dump($usuario['Foto']);

if ($usuario['Nivel'] == 1) {
    $usuario['Nivel'] = 'Usuário';
}
else if ($usuario['Nivel'] == 2) {
    $usuario['Nivel'] = 'Moderador';
} else {
    $usuario['Nivel'] = 'Administrador';
}

var_dump($usuario['Nivel']);


?>

<div class="container my-5">
    <div class="card-perfil-publico row">
        <div class="col-md-3">
            <div class="box-info-perfil">
                <img src="/FORUM_CODEIGNITER/assets/img/usuarios/<?php echo $usuario['Foto']; ?>">
                <br><br>
                <p><b><?php echo $usuario['Nivel'] . ':</b> ' .$usuario['Nome'] . ' ' . $usuario['Sobrenome'] ?></p>
            </div>
        </div>
    </div>
</div>