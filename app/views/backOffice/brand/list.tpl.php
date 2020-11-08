<div class="container my-4">
    <a href="<?= $router->generate('brand-add') ?>" class="btn btn-success float-right">Ajouter</a>
    <h2>Liste des Marques</h2>
    <table class="table table-hover mt-4">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <th scope="col">Ordre footer</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($brandsList as $brand) : ?>
                <tr>
                    <th scope="row"><?= $brand->getId() ?></th>
                    <td><?= $brand->getName() ?></td>
                    <td><?= $brand->getFooterOrder() ?></td>
                    <td class="text-right">
                        <a href="<?= $router->generate('brand-modify', ['brand_id' => $brand->getId()]).'?token='.$_SESSION['token'] ?>" class="btn btn-sm btn-warning">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </a>
                        <!-- Example single danger button -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?= $router->generate('brand-delete', ['brand_id' => $brand->getId()]) ?>">Oui, je veux supprimer</a>
                                <a class="dropdown-item" href="#" data-toggle="dropdown">Oups !</a>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>