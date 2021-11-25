sou a página de regras

<!-- MODAL ALERTA DE PRIVACIDADE -->
<div class="modal fade" id="AlertaPrivacidade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Política de privacidade</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="resultadoPrivacidade">
                    
                </div>
                <p>Termos de politica de privacidade</p>
                
            </div>
            <div class="modal-footer">
                <a href="/FORUM_CODEIGNITER/public/Usuario/logout" class="btn btn-danger">Discordo</a>
                <div class="resultadoA"></div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        function verificar_privacidade()
        {
            $.ajax({
                url:"/FORUM_CODEIGNITER/public/ValidaSessao/verificarPrivacidade/" + <?php echo json_encode(session()->id) ?> + "/" + <?php echo json_encode(session()->privacidade) ?>,
                method: 'POST',
                dataType: 'json'
                }).done(function(alertaPrivacidade){
                    console.log(alertaPrivacidade);
                    // var box_comment = document.querySelector('.resultadoPrivacidade');
                    // while(box_comment.firstChild){
                    //     box_comment.firstChild.remove();
                    // }
                    for (var i = 0; i < alertaPrivacidade.length; i++) {

                        if (<?php echo json_encode(session()->has('id')) ?> == false) {
                            
                        } else {
                            if (<?php echo json_encode(session()->privacidade) ?> == 0) {
                                $('#AlertaPrivacidade').modal('show');
                            } else {
                                $('#AlertaPrivacidade').modal('hide');
                            }
                        }
                        $('.resultadoA').prepend(
                            '<form method="post" id="formPrivacidade">' +
                                '<input type="hidden" id="idusuario" name="idusuario" value="'+ alertaPrivacidade[i].ID +'">' +
                                '<button type="submit" form="formPrivacidade" class="btn btn-primary">Concordo</button>' +
                            '</form>');
                    }   
                    $("#formPrivacidade").submit(function(e) {
                        e.preventDefault();    
                        var formData = new FormData(this);

                        $.ajax({
                            url: '/FORUM_CODEIGNITER/public/Usuario/privacidadeConfirmar',
                            type: 'POST',
                            data: formData,
                            cache: false,
                            contentType: false,
                            processData: false
                            
                        }).done(function(){
                            
                            $('#idusuario');
                            alert('Você concordou com os dados de privacidade, curta o conteúdo com boas práticas!')
                            $('#AlertaPrivacidade').modal('hide');
                        });
                    });   
            });
        }
        verificar_privacidade();   
    });
</script>