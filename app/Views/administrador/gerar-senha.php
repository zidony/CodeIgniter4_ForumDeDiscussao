<?php

// echo '<pre>';
// var_dump();

helper('form');
    echo form_open('Administrador/senhaGerada');
        echo form_label('ID');
        echo '<br>';
        echo form_input('ID',$usuario['ID'], 'readonly');
        echo '<br><br>';

        echo form_label('Nome usuário');
        echo '<br>';
        echo form_input('nome', $usuario['Nome'], 'readonly');
        echo '<br><br>';

        echo form_label('RM usuário');
        echo '<br>';
        echo form_input('rm', $usuario['RM'], 'readonly');
        echo '<br><br>';

        echo form_label('E-mail usuário');
        echo '<br>';
        echo form_input('email', $usuario['Email'], 'readonly');
        echo '<br><br>';

        echo form_label('Senha do usuário');
        echo '<br>';
        echo form_input('senha','', 'required');
        echo '<br><br>';

        echo form_submit('mysubmit', 'Gerar senha', 'class="btn btn-primary"');
    echo form_close();


?>