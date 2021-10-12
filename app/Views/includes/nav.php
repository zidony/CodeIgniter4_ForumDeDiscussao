<header>
    <div class="topo-contato">
        <div class="">
            <a href="" title="twitter"><i class="bi bi-twitter icones-topo"></i></a>
            <a href="" title="instagram"><i class="bi bi-instagram icones-topo"></i></a>
            <a href="" title="facebook"><i class="bi bi-facebook icones-topo"></i></a>
            <a href="" title="whatsapp"><i class="bi bi-whatsapp icones-topo"></i></a>
        </div>

    </div>
    <nav class="navbar navbar-expand-lg navbar-light navegacao">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img class="navbar-brand logo" src="/FORUM_CODEIGNITER/assets/img/login/logo.png" alt=""></a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-three-dots-vertical icone-menu"></i>
            </button>
            <div class="collapse navbar-collapse flex-grow-0" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="link-nav active" aria-current="page" href="http://localhost/FORUM_CODEIGNITER/public/" title="home"><i class="bi bi-house-door icon-home"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="link-nav" aria-current="page" href="#">RECENTES</a>
                    </li>
                    <li class="nav-item">
                        <a class="link-nav" href="#">CATEGORIAS</a>
                    </li>
                    <li class="nav-item">
                        <a class="link-nav" href="#">SOBRE O FÓRUM</a>
                    </li>
                        <?php
                            use App\Controllers\Usuario;
                            echo '<li class="nav-item">';
                            if (session()->has('id')){
                                echo "<a href='usuario/logout' class='link-nav'>Logout</a>";
                                echo 'Seja bem vindo: ' . session()->usuario;
                                //chama o método nivel que terá as permissões para cada tipo de usuário logado (usuario, mod e adm)
                                // $obj = new Usuario();
                                // $obj->nivel();
                            } else {
                                echo "<a href='usuario/login' class='link-nav start-session'>INICIAR SESSÃO</a>";
                            }

                            echo '</li>';
                        ?>
                </ul>
            </div>
        </div>
    </nav>
    <?php
        //chama o método nivel que terá as permissões para cada tipo de usuário logado (usuario, mod e adm)
        // if (session()->has('id')){
        //     $obj = new Usuario();
        //     $obj->nivel();
        // }
    ?>

</header>

