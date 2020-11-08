<div class="container mt-4">
    <h2>Gestion affichage de la page d'accueil</h2>
    <form action="<?= $router->generate('display-update') ?>" method="POST" class="mt-5">
    <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
        <div class="row">
            <?php for($i = 1; $i < 6; $i++) : ?>
            <div class="col">
                <div class="form-group">
                    <label for="<?= 'location'.$i ?>">Emplacement #<?= $i ?></label>
                    <select class="form-control" id="<?= 'location'.$i ?>" name="location[<?= $i ?>]">
                        <option value="">choisissez :</option>
                        <?php foreach($categories as $category) : ?>
                            <option value="<?= $category->getId() ?>" <?= $category->getHomeOrder() == $i ? 'selected' : '' ?> >
                                <?= $category->getName() ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <?php endfor ?>
        </div>
        <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
    </form>
</div>