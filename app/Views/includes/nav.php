<header>
    <div class="topo-contato">
            <a href="" title="twitter"><i class="bi bi-twitter icones-topo"></i></a>
            <a href="" title="instagram"><i class="bi bi-instagram icones-topo"></i></a>
            <a href="" title="facebook"><i class="bi bi-facebook icones-topo"></i></a>
            <a href="" title="whatsapp"><i class="bi bi-whatsapp icones-topo"></i></a>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light navegacao">
        <div class="container-fluid">
            <a class="navbar-brand" href="/FORUM_CODEIGNITER/public/"><img class="navbar-brand logo" src="/FORUM_CODEIGNITER/assets/img/login/logo.png" alt=""></a>
            <div class="itens-view-nav-mobile">
                <?php 
                    use App\Controllers\ValidaSessao;
                    $obj = new ValidaSessao();
                    $obj->mostrarFotoPerfilNav();
                ?>
                <a class="navbar-toggler border-0" aria-current="page" href="/FORUM_CODEIGNITER/public/" title="home"><i class="bi bi-house-door icon-home"></i></a>
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="bi bi-three-dots-vertical icone-menu"></i>
                </button>
            </div>
            <div class="collapse navbar-collapse flex-grow-0" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="link-nav active" aria-current="page" href="/FORUM_CODEIGNITER/public/" title="home"><i class="bi bi-house-door icon-home"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="link-nav" href="/FORUM_CODEIGNITER/public/#sobre">SOBRE O FÓRUM</a>
                    </li>
                        <?php
                            use App\Controllers\Usuario;

                            if (session()->has('id')){
                                
                                $obj = new Usuario();
                                $obj->consultaNivel();
                                echo "<li class='nav-item'><a href='/FORUM_CODEIGNITER/public/usuario/perfil/" . session()->id ."' class='link-nav'>PERFIL</a></li>";
                                if (session()->nivel == 3)
                                {
                                    echo "<li class='nav-item'><a href='/FORUM_CODEIGNITER/public/administrador/index' class='link-nav'>PAINEL ADMINISTRATIVO</a></li>";
                                }
                                echo "<li class='nav-item'><a href='/FORUM_CODEIGNITER/public/usuario/logout' class='link-nav logout'>LOGOUT</a></li>";
                            } else {
                                echo "<li class='nav-item'><a href='/FORUM_CODEIGNITER/public/usuario/login' class='link-nav start-session'>INICIAR SESSÃO</a></li>";
                            }
                        ?>
                </ul>
            </div>
        </div>
    </nav>


</header>

