<?php
    use App\Controllers\ValidaSessao;
    $adm = new ValidaSessao();
    $adm->validarPermissaoAdm();
?>
    <div class="container">
        <br />
        <div class="d-flex flex-wrap">
            <a href="/FORUM_CODEIGNITER/public/administrador/index" class="button-back p-3 my-3">VOLTAR</a>
        </div>
        <br />
        <h1>CADASTRO DE CATEGORIAS</h1>
        <?php 

            $input = [
                'class' => 'form-control',
                'required' => 'required'
            ];

            $inputT = [
                'class' => 'form-control',
                'required' => 'required',
                'placeholder' => 'Tente: Desenvolvimento de sistemas'
            ];

            $inputL = [
                'class' => 'form-control',
                'required' => 'required',
                'placeholder' => 'Tente: desenvolvimento-de-sistemas'
            ];

            $inputConteudo = [
                'class' => 'form-control',
                'required' => 'required',
                'maxlength' => '65',
                'rows' => '2',
                'placeholder' => 'Tente: Acesse agora e fique por dentro das discussões que estão rolando.'
            ];

            helper('form');
            echo form_open_multipart('Administrador/criar_categoria');
                echo form_label('Título');
                echo '<br>';
                echo form_input('titulo','', $inputT);
                echo '<br>';

                echo form_label('Imagem');
                echo '<br>';
                echo form_upload('img[]', '', $input);
                echo '<br>';

                echo form_label('Conteúdo');
                echo '<br>';
                echo form_textarea('conteudo', '', $inputConteudo);
                echo '<br>';

                echo form_label('Link amigável');
                echo '<br>';
                echo form_input('link', '', $inputL);
                echo '<br>';

                echo '<div class="text-center">';
                echo form_submit('mysubmit', 'Criar categoria', 'class="button-submit py-3 my-3"');
                echo '</div>';
            echo form_close();

        ?>



        <br />
        <br />
        <br />
        <h1>CATEGORIAS REGISTRADAS NO SISTEMA</h1><br />
        <div class="form-group">
            <div class="input-group">
                <input type="text" name="search_text" id="search_text" placeholder="Pesquise por Título, Link Amigável" class="form-control" />
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
                    url:"/FORUM_CODEIGNITER/public/administrador/fetch_categoria",
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



