<center>

<h2>Login:</h2>
<img src="../../assets/img/guias/login.png" width="800" height="600">
<p>
1. Como dito anteriormente publicações e comentários só poderam ser realizados depois de efetuado um login no sistema. No entanto, somente quem possuir um Registro de Matrícula (RM) e um email institucional poderá criar uma conta e fazer login, ou seja, alunos e professores.
2. Caso esqueça sua senha você poderá clicar em "ESQUECEU SUA SENHA?". Fique ciente que existe algumas etapas para realizar o processo de troca de senha caso você a tenha esquecido. Essas etapas são explicadas mais abaixo.
3. Caso você seja um aluno ou um professor e ainda não possui uma conta neste sistema, clique no botão "REGISTRE-SE" para criar uma conta.
4.  Caso haja algum problema nesta parte do sistema você também pode contatar o suporte técnico clicando no botão "AJUDA/SUPORTE".

</p>
<br>
<h2> Criando uma conta:</h2>
<img src="../../assets/img/guias/cadusuario.png" width="800" height="600">
<p>
1. Para se registrar, preencha todos os campos com seus dados corretamente. Caso você seja aluno ou professor e não consiga criar uma conta, certifique-se com a direção de sua escola se o seu email institucional e seu RM já foram registrados no banco de dados do fórum para possibilitar a criação da conta.     

</p>
<br>
<h2>Página inicial:</h2>
<img src="../../assets/img/guias/paginainicial.png" width="800" height="600">
<p>
1. Ao entrar no site do fórum você se deparará com esta página, onde poderá saber as regras, guias e pedir ajuda no manuseio da ferramenta caso seja necessário. Nela também é possível acessar as categorias de debate, as quais servem para os usuários realizarem perguntas que estejam dentro do tema da categoria em questão.
2. No lado direito você poderá visualisar as duas últimas publicações realizadas neste fórum, as quais independem de qual categoria elas pertençam. Ao clicar em "acessar publicação" você será redirecionado para a página contendo a publicação completa.
3. Ao clicar no botão "acessar" presente nas categorias, você será redirecionado para uma página contendo todas as publicações que foram feitas dentro daquela categoria específica. Entretanto, será possível apenas visualizar as publicações. Para realizar uma publicação ou responder à uma, você deverá realizar um login,  para isso clique em qualquer um dos dois botôes onde está escrito "iniciar sessão".

</p>
<img src="../../assets/img/guias/usuariologado.png" width="800" height="600">
<p>
4. Após fazer o login, ao lado direito da tela, você terá acesso ao seu perfil de usuário e um botão para deslogar do sistema "logout" aparecerá no menu na parte superior da tela.

</p>

<br>
<h2>Fazendo uma publicação: </h2>
<img src="../../assets/img/guias/publicacao.png" width="800" height="600">
<p>
1.Após fazer login e clicar em uma categoria qualquer, você se deparara com esta página. Nela será possível visualizar e também realizar publicações.
2.O formulário para publicação se encontra logo abaixo do banner da página. Nele você deverá criar um título para sua pergunta e logo após colocar o conteúdo no campo abaixo do título. Também é possível adicionar uma imagem à sua publicação caso ache necessário.

</p>

<br>
<h2>Perfil de usuário privado:
</h2>
<img src="../../assets/img/guias/perfilusuario.png" width="800" height="600">
<p>
1. Na tela de perfil de usuário PRIVADO é possível fazer a alteração de alguns dados do usuário como, foto de perfil, nome, sobrenome, data de nascimento e senha.

</p>

<br>
<?php



if(session()->nivel == 3)
{
    
    ?>
    <h2>Administrador:</h2><img src='../../assets/img/guias/paineladministrativo.png' width='800' height='600'>1. Esta tela só pode ser acessada por um usuário que tenha o nível de permissão 'administrador'. Nela você pode registrar um novo usuário, ver todos os usuários registrados, registrar categorias, ver as categorias registradas e inserir novos RMs e emails institucionais de alunos novos na instituição.<img src='../../assets/img/guias/cadrms.png' width='800' height='600'>
    2. Nesta é feita o cadastro de RMs e E-mails institucionais para que o aluno consiga criar uma conta para ele. <img src='../../assets/img/guias/rms.png' width='800' height='600'>
    3. Nesta é possível visualizar os RMs e E-mails institucionais já cadastrados e também desativa-los se necessário.;

    
    <img src="../../assets/img/guias/rms.png" width="800" height="600">
    3. Nesta é possível visualizar os RMs e E-mails institucionais já cadastrados e também desativa-los se necessário.
    
    <img src="../../assets/img/guias/cadcategorias.png" width="800" height="600">
    4. Esta é a tela para criar uma nova categoria, na qual você deve também criar um link amigável.
    
    <img src='../../assets/img/guias/categorias.png' width='800' height='600'>
    5. Aqui é possível ver as categorias já registradas no sistema e também desativa-las se necessário.
    
    6. A tela para registrar um novo usuário não sofre alterações para o administrador, seguindo todos os critérios que um usuário comum necessita para criar sua conta.
    
    <img src='../../assets/img/guias/usuarios.png' width='800' height='600'>
    7. Esta tela apresenta todos os usuários registrados no sistema, ela também dá a possibilidade de dasativar um usuário caso seja necessário."
    

   ;



<?php }?>


</center>

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