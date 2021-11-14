<?php

echo '<pre>';
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