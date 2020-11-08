<div class="container my-4">
    <a href="<?= $router->generate('type-list') ?>" class="btn btn-success float-right">Retour</a>
    <h2><?= isset($type) ? 'Modifier' : 'Ajouter' ?> une marque</h2>

    <form action="<?= isset($type) ? $router->generate('type-update', ['type_id' => $type->getId()]) : $router->generate('type-create')?>" method="POST" class="mt-5">
        <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
        <div class="form-group">
            <label for="name">Nom</label>
            <input type="text" class="form-control" id="name" placeholder="Nom de la marque" name="name" value="<?= isset($type) ? $type->getName() : '' ?>">
        </div>
        <div class="form-group">
            <label for="subtitle">Ordre dans le footer</label>
            <input type="number" class="form-control" id="subtitle" placeholder="Ordre dans le footer" aria-describedby="subtitleHelpBlock" name="footerOrder" value="<?= isset($type) ? $type->getFooterOrder() : '' ?>">
            <small id="subtitleHelpBlock" class="form-text text-muted">
                Détermine l'ordre d'affichage dans le footer
            </small>
        </div>
        <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
    </form>
</div>