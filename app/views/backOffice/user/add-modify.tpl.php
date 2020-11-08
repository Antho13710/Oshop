<div class="container my-4">
    <a href="<?= $router->generate('user-list') ?>" class="btn btn-success float-right">Retour</a>
    <h2><?= isset($user) ? 'Modifier' : 'Ajouter' ?> un utilisateur</h2>

    <?php if(isset($error)) : ?>
        <div id="name-error" class="alert alert-danger"><?= $error ?></div>
    <?php endif ?>
    <form  id="" action="<?= isset($user) ? $router->generate('user-update', ['user_id' => $user->getId()]) : $router->generate('user-create')?>" method="POST" class="mt-5">
        <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" id="email" placeholder="M@il de l'utilisateur" name="email" value="<?= isset($user) ? $user->getEmail() : '' ?>">
        </div>
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="text" class="form-control" id="password" placeholder="Mot de passe" name="password">
            <div id="name-error" class="alert alert-danger hide"></div>
        </div>
        <div class="form-group">
            <label for="name">Confirmation</label>
            <input type="password" class="form-control" id="confirm" placeholder="Confirmer le mot de passe" name="confirm">
        </div>
        <div class="form-group">
            <label for="name">Nom</label>
            <input type="text" class="form-control" id="name" placeholder="Nom de l'utilisateur" name="lastname" value="<?= isset($user) ? $user->getLastname() : '' ?>">
            <div id="name-error" class="alert alert-danger hide"></div>
        </div>
        <div class="form-group">
            <label for="firstname">Prénom</label>
            <input type="text" class="form-control" id="firstname" placeholder="Prénom de l'utilisateur" name="firstname" value="<?= isset($user) ? $user->getFirstname() : '' ?>">
            <div id="name-error" class="alert alert-danger hide"></div>
        </div>
        <div class="form-group">
            <label for="role">Role</label>
            <select class="custom-select" name="role" id="role">
                <option value="admin" <?php if(isset($user) && $user->getRole() == 'admin') { echo 'selected'; } ?>>Admin</option>
                <option value="catalog-manager" <?php if(isset($user) && $user->getRole() == 'catalog-manager') { echo 'selected'; } ?>>Catalog Manager</option>
            </select>
            <div id="name-error" class="alert alert-danger hide"></div>
        </div>
        <div class="form-group">
            <label for="status">Statut</label>
            <select class="custom-select" name="status" id="status">
                <option value="">-</option>
                <option value="1" <?php if(isset($user) && $user->getStatus() == 1) { echo 'selected'; } ?>>Actif</option>
                <option value="2" <?php if(isset($user) && $user->getStatus() == 2) { echo 'selected'; } ?>>Désactivé</option>
            </select>
            <div id="subtitle-error" class="alert alert-danger hide"></div>
        </div>
        <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
    </form>
</div>