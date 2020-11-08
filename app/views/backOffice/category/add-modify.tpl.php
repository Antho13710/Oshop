<div class="container my-4">
    <a href="<?= $router->generate('category-list') ?>" class="btn btn-success float-right">Retour</a>
    <h2><?= isset($category) ? 'Modifier' : 'Ajouter' ?> une categorie</h2>

    <form  id="add-form" action="<?= isset($category) ? $router->generate('category-update', ['category_id' => $category->getId()]) : $router->generate('category-create')?>" method="POST" class="mt-5">
        <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
        <div class="form-group">
            <label for="name">Nom</label>
            <input type="text" class="form-control" id="name" placeholder="Nom de la catégorie" name="name" value="<?= isset($category) ? $category->getName() : '' ?>">
            <div id="name-error" class="alert alert-danger hide"></div>
        </div>
        <div class="form-group">
            <label for="subtitle">Sous-Titre</label>
            <input type="text" class="form-control" id="subtitle" placeholder="Sous-titre" aria-describedby="subtitleHelpBlock" name="subtitle" value="<?= isset($category) ? $category->getSubtitle() : '' ?>">
            <small id="subtitleHelpBlock" class="form-text text-muted">
                Sera affiché sur la page d'accueil comme bouton devant l'image
            </small>
            <div id="subtitle-error" class="alert alert-danger hide"></div>
        </div>
        <div class="form-group">
            <label for="picture">Image</label>
            <input type="text" class="form-control" id="picture" placeholder="image jpg, gif, svg, png" aria-describedby="pictureHelpBlock" name="picture" value="<?= isset($category) ? $category->getPicture() : '' ?>">
            <small id="pictureHelpBlock" class="form-text text-muted">
                URL relative d'une image (jpg, gif, svg ou png) fournie sur <a href="https://benoclock.github.io/S06-images/" target="_blank">cette page</a>
            </small>
            <div id="picture-error" class="alert alert-danger hide"></div>
        </div>
        <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
    </form>
</div>