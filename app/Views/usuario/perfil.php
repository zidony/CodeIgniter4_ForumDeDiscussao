<?php

var_dump(session()->foto);

?>

<div class="card-perfil">
    <img src="/FORUM_CODEIGNITER/assets/img/usuarios/<?php echo session()->foto ?>" alt="">
    <p>Nome de usuário</p>
    <a href="usuario/perfil/<?php echo session()->id ?>">Acessar perfil de usuário</a>
</div>