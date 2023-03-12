
        <nav class="navbar navbar-expand-lg align-items-start">
            <div class="container-fluid col-10">
            <a class="navbar-brand" href="/"><img src="<?= ASSETS.DIRECTORY_SEPARATOR.'logo.png' ?>" alt="logo quai antique" width="100px"></a>
            <button class="navbar-toggler secondary-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 ms-5 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="/plats" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Découvrir
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/nos-menus">Nos menus</a></li>
                        <li><a class="dropdown-item" href="/a-la-carte">A la carte</a></li>
                        <!-- <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li> -->
                    </ul>
                </li>
                <?php
                if (isset($_SESSION['user']) && $_SESSION['user']->getRole() === 'admin') 
                {
                ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="/plats" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Administration
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/plats">Liste des plats</a></li>
                        <li><a class="dropdown-item" href="/creer-plat">Créer un plat</a></li>
                        <li><a class="dropdown-item" href="/gerer-gallerie">Gérer gallerie</a></li>
                        <li><a class="dropdown-item" href="/ajouter-categorie">Categories</a></li>
                        <!-- <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li> -->
                    </ul>
                </li>
                <?php } ?>
            </ul>
            </div>
        </div>
        <div class="col-2 d-flex align-items-center" style="height: 70px">
        <?php
            if (!isset($_SESSION['user'])) 
            {
                ?>
                <a class="" href="/login"><i style="font-size:2rem;" class="bi bi-person"></i></a>
            <?php
                }
                else { ?>
                <a class="" href="/logout"><i style="font-size:2rem;" class="bi bi-box-arrow-right"></i></a>
            <?php
                } ?>
        </div>
    </nav>

