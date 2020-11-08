<div class="container my-4">
    <a href="<?= $router->generate('brand-list') ?>" class="btn btn-success float-right">Retour</a>
    <h2><?= isset($brand) ? 'Modifier' : 'Ajouter' ?> une marque</h2>

    <form action="<?= isset($brand) ? $router->generate('brand-update', ['brand_id' => $brand->getId()]) : $router->generate('brand-create')?>" method="POST" class="mt-5">
        <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
        <div class="form-group">
            <label for="name">Nom</label>
            <input type="text" class="form-control" id="name" placeholder="Nom de la marque" name="name" value="<?= isset($brand) ? $brand->getName() : '' ?>">
        </div>
        <div class="form-group">
            <label for="subtitle">Ordre dans le footer</label>
            <input type="number" class="form-control" id="subtitle" placeholder="Ordre dans le footer" aria-describedby="subtitleHelpBlock" name="footerOrder" value="<?= isset($brand) ? $brand->getFooterOrder() : '' ?>">
            <small id="subtitleHelpBlock" class="form-text text-muted">
                Détermine l'ordre d'affichage dans le footer
            </small>
        </div>
        <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
    </form>
</div>