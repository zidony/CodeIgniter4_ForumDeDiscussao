<div class="container mt-3">
    <h2 class="titulo-sobre">Regras para o uso do Fórum:</h2>
    <br>
    <p class="conteudo-sobre"><span class="numeracao">1- </span>Seja tolerante com opiniões diferentes da sua, não crie brigas nos debates do fórum;
    Ao participar de um debate, evite desviar muito do assunto do        tópico. Se desejar discutir um assunto diferente do que está sendo debatido no tópico, faça uma busca no fórum pelo assunto de seu interesse. Caso não encontre resultados, crie um novo tópico e convide seus amigos para o debate;</p><hr>

    <p class="conteudo-sobre"><span class="numeracao">2- </span>Não repetir tópicos existentes. Antes de criar um novo tópico, verifique se o assunto já não está sendo debatido no fórum. Faça proveito do sistema de busca;</p><hr>
    <p class="conteudo-sobre"><span class="numeracao">3- </span>Não postar conteúdo ofensivo ou pornográfico;</p><hr>

    <p class="conteudo-sobre"><span class="numeracao">5- </span>Não insultar, ofender, caluniar ou difamar outros usuários do fórum;</p><hr>

    <p class="conteudo-sobre"><span class="numeracao">6- </span>Não fazer ameaças de qualquer natureza;</p><hr>

    <p class="conteudo-sobre"><span class="numeracao">7- </span>Não postar propaganda, nem fazer spam;</p><hr>

    <p class="conteudo-sobre"><span class="numeracao">8- </span>Não criar tópicos rasos para divulgar conteúdo de seu site/blog. Traga algo interessante para os outros usuários debaterem dentro do nosso fórum.</p><hr>

    <p class="conteudo-sobre"><span class="numeracao">9- </span>É proibida a publicação de informações como endereço, e-mails, números de telefone de usuários sem a permissão dos mesmos. Recomendamos fortemente que os usuários não divulguem os seus dados; evitando, assim, o recebimento de SPAMS e abordagens indevidas.</p><hr>

    <p class="conteudo-sobre"><span class="numeracao">10- </span>O Moderador se reserva ao direito de excluir todos os posts e/ou mensagens que infringirem as normas acima podendo, inclusive, banir um usuário dependendo da gravidade do caso, sem notificação-prévia.</p><hr>
    
    <p class="conteudo-sobre"><span class="numeracao">11- </span>Será considerado usuário "coveiro" aquele que resgatar um tópico em que:<br>
    a- postar mensagem obsoleta que nada contribui ao assunto;<br>
    b- A denominação e aplicação de punições será feita pela Administração do fórum.<br>
    c- Será dada uma primeira advertência quando for caracterizado flooder ou coveiro;<br>
    d- Se houver insistência, as penas serão:<br>
    e- Redução do número de mensagens do contador.<br>
    f- Eliminação completa de todas as mensagens do contador</p><hr>
      
    <p class="conteudo-sobre"><span class="numeracao">12- </span>Proibido sitar nomes e bytes e bites de arquivos piratas.</p><hr>

    <p class="conteudo-sobre"><span class="numeracao">13- </span>Tópicos sem sentido serão fechados sem aviso prévio</p><hr>

    <p class="conteudo-sobre"><span class="numeracao">14- </span>Proibido publicar imagens ou fotos sem autorização do autor</p><hr> 

    <p class="conteudo-sobre"><span class="numeracao">15- </span>Não publique informações sigilosas. Moderadores removerão informações pessoais para proteger a privacidade dos usuários.</p><hr>

    <p class="conteudo-sobre"><span class="numeracao">16- </span>Insira o link para conteúdos externos, em vez de publicá-los em sua totalidade, a menos que seja o detentor dos direitos autorais ou tenha permissão do detentor dos direitos autorais.</p><hr>

    <p class="conteudo-sobre"><span class="numeracao">17- </span>O Fórum do curso conta com perfis de moderador: “Moderador Prof.”, “Moderador Tutor.”. Eles podem atuar direcionando a discussão, fazendo intervenções, comentários e dicas; além de moderarem a atuação dos usuários- podendo banir ou adverti-los e excluir mensagens e/ou tópicos.</p><hr>

    <p class="conteudo-sobre"><span class="numeracao">18- </span>Aqueles usuários que se sentirem ofendidos de alguma forma ou ue identificarem alguma mensagem e/ou tópicos abusivos, podem notificar os moderadores do Fórum por meio do ícone de alerta no topo de cada postagem.</p><hr>

    <p class="conteudo-sobre"><span class="numeracao">19- </span>A leitura das Regras Gerais deste Fórum é obrigatória para todos que aderirem e se inscreverem para participar deste fórum de debates e os casos omissos serão julgados pela equipe de moderação e/ou administração do Fórum;</p><hr>

    <p class="conteudo-sobre"><span class="numeracao">20- </span>Não é permitida a postagem de figuras que violem qualquer uma das outras regras do Fórum;</p><hr>

    <p class="conteudo-sobre"><span class="numeracao">21- </span>É importante que se observe a Categoria/Sub-Categoria na qual irá criar um novo Tópico e/ou Enquete. Caso o post esteja na classificação incorreta, o Moderador poderá realocá-lo.</p>

</div>
<br><br><br>



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
                <p>Termos de politica de privacidade</p><hr>
                
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