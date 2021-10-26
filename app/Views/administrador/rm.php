<?php
    use App\Controllers\ValidaSessao;
    $adm = new ValidaSessao();
    $adm->validarPermissaoAdm();
?>

<div class="container">
    <br />
    <div class="d-flex flex-wrap">
        <a href="index" class="button-back p-3 my-3">VOLTAR</a>
    </div>
    <br />
    <h1>CADASTRO DE CATEGORIAS</h1>
    <?php

    $input = [
        'class' => 'form-control',
        'required' => 'required'
    ];

    $inputrm = [
        'class' => 'form-control w-25',
        'required' => 'required'
    ];

    helper('form');
    echo form_open('Administrador/registraRM');

        echo form_label('RM');
        echo '<br>';
        echo form_input('rm', '', $inputrm);
        echo '<br><br>';

        echo form_label('Nome');
        echo '<br>';
        echo form_input('nome', '', $input);
        echo '<br><br>';

        echo form_label('E-mail institucional');
        echo '<br>';
        echo form_input('email', '', $input);
        echo '<br><br>';

        echo '<div class="text-center">';
        if (isset($_GET['error'])) { echo '<b style="color: red;">Esse RM já consta em nosso banco de dados!</b><br><br>'; }
        echo form_submit('mysubmit', 'Cadastrar dados', 'class="button-submit py-3 my-3"');
        echo '</div>';
        
    echo form_close();


    ?>

    <br />
    <br />
    <h1>RMs REGISTRADOS NO SISTEMA</h1><br />
    <div class="form-group">
        <div class="input-group">
            <input type="text" name="search_text" id="search_text" placeholder="Pesquise..." class="form-control" />
        </div>
    </div>
    <br />
    <div id="result"></div>
</div>
    <div style="clear:both"></div>

    <br />
    <br />
    <br />
    <br />
    <script>
        $(document).ready(function(){

            load_data();

            function load_data(query)
            {
                $.ajax({
                    url:"<?php echo base_url(); ?>/administrador/fetch_rm",
                    method:"POST",
                    data:{query:query},
                    success:function(data){
                        $('#result').html(data);
                    }
                })
            }

            $('#search_text').keyup(function(){
                var search = $(this).val();
                if(search != '')
                {
                    load_data(search);
                }
                else
                {
                    load_data();
                }
            });
        });
    </script>
</div>