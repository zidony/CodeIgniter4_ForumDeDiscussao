<?php
    use App\Controllers\ValidaSessao;
    $adm = new ValidaSessao();
    $adm->validarPermissaoAdm();
?>
   <link rel="stylesheet" href="/FORUM_CODEIGNITER/css/style-tables.css">
    <title>RMs registradas</title>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" /> -->
</head>
<body>

<div class="container">
    <br />
    <div class="d-flex flex-wrap">
        <a href="index" class="button-back p-3 my-3">VOLTAR</a>
    </div>
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

    <?php


    // var_dump();


    ?>

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