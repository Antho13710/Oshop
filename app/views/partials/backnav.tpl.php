<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="<?= $router->generate('main-home') ?>">oShop</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="<?= $router->generate('main-home') ?>">Accueil <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $router->generate('category-list') ?>">Catégories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $router->generate('product-list') ?>">Produits</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $router->generate('type-list') ?>">Types</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $router->generate('brand-list') ?>">Marques</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Tags</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $router->generate('display-modify') ?>">Sélections Accueil &amp; Footer</a>
                    </li>
                </ul>
                <div style="float: right;">
                    <?php if( isset( $_SESSION['connectedUser'] ) ) : ?>
                        <b>Bonjour <?= $_SESSION['connectedUser']->getFirstname() ?></b>
                        <br>
                        <a href="<?= $router->generate('user-list') ?>">
                            Utilisateurs
                        </a>
                        <a href="<?= $router->generate( 'user-logout' ) ?>">
                            Déconnexion
                        </a>
                    <?php else : ?>
                        <a href="<?= $router->generate( 'user-login' ) ?>">
                            Connexion
                        </a>
                    <?php endif; ?>
                </div>
                </div>
            </div>
        </div>
    </nav>