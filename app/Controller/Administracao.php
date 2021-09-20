<?php

    require '../../Models/Usuarios.php';

    function listaUsuarios()
    {
        return select_all_user();  
    }

    function verificaNivel($value)
    {
        # Verifica os niveis de usuários e converte em string (amigável ao cliente)
        if ($value['Nivel']  == 1){ echo 'Usuário'; }
        if ($value['Nivel']  == 2){  echo 'Moderador'; }
        if ($value['Nivel']  == 3){ echo 'Administrador'; }
    }

    function verificaBadges($value)
    {
        # Verifica os niveis de usuários e converte em string (amigável ao cliente)
        if ($value['Badges']  == 1){ echo 'Usuário'; }
        if ($value['Badges']  == 2){ echo 'Moderador'; }
        if ($value['Badges']  == 3){ echo 'Administrador'; }
    }

    function verificaAtivo($value)
    {
        # Verifica se o usuário está ou não ativo (amigável ao cliente)
        if ($value['Ativo']  == 1){ echo '<b style="color: #137eba">Sim</b>'; }
        if ($value['Ativo']  == 0){  echo '<b style="color: #bb262e">Não</b>'; }
    }





?>