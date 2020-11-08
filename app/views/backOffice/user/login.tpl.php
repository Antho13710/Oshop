<div class="container my-4">
    <h2>Se connecter</h2>

    <form action="<?= $router->generate('user-connect') ?>" method="POST" class="mt-5">
        <?php if(!empty($errorList)) : ?>
            <div class="alert alert-danger">
                <?php foreach($errorList as $error) : ?>
                    <?= $error ?>
                <?php endforeach ?>
            </div>
        <?php endif ?>
        <div class="form-group">
            <label for="name">Adresse m@il</label>
            <input type="text" class="form-control" id="mail" placeholder="adresse@mail.com" name="email" autofocus required>
        </div>
        <div class="form-group">
            <label for="subtitle">Mot de passe</label>
            <input type="password" class="form-control" id="password" placeholder="Mot de passe" aria-describedby="subtitleHelpBlock" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
    </form>
</div>