<div class="container my-4">
    <p class="display-4">
        Bienvenue dans le backOffice <strong>Dans les shoe</strong>...
    </p>

    <div class="row mt-5">
        <div class="col-12 col-md-6">
            <div class="card text-white mb-3">
                <div class="card-header bg-primary">Liste des catégories</div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nom</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($categoryListForHome as $category) : ?>
                                <tr>
                                    <th scope="row"><?= $category->getId() ?></th>
                                    <td><?= $category->getName() ?></td>
                                    <td class="text-right">
                                        <a href="<?= $router->generate('category-update', ['category_id' => $category->getId()]) ?>" class="btn btn-sm btn-warning">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </a>
                                        <!-- Example single danger button -->
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="<?=$router->generate('category-delete', ['category_id' => $category->getId()]).'?token='.$_SESSION['token']  ?>">Oui, je veux supprimer</a>
                                                <a class="dropdown-item" href="#" data-toggle="dropdown">Oups !</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                    <a href="<?= $router->generate('category-list') ?>" class="btn btn-block btn-success">Voir plus</a>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card text-white mb-3">
                <div class="card-header bg-primary">Liste des produits</div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nom</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($productsListForHome as $product) : ?>
                                <tr>
                                    <th scope="row"><?= $product->getId() ?></th>
                                    <td><?= $product->getName() ?></td>
                                    <td class="text-right">
                                        <a href="<?= $router->generate('product-update', ['product_id' => $product->getId()]) ?>" class="btn btn-sm btn-warning">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </a>
                                        <!-- Example single danger button -->
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="<?= $router->generate('product-delete', ['product_id' => $product->getId()]).'?token='.$_SESSION['token']  ?>">Oui, je veux supprimer</a>
                                                <a class="dropdown-item" href="#" data-toggle="dropdown">Oups !</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                    <a href="<?= $router->generate('product-list') ?>" class="btn btn-block btn-success">Voir plus</a>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card text-white mb-3">
                <div class="card-header bg-primary">Liste des marques</div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nom</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($brandsListForHome as $brand) : ?>
                                <tr>
                                    <th scope="row"><?= $brand->getId() ?></th>
                                    <td><?= $brand->getName() ?></td>
                                    <td class="text-right">
                                        <a href="<?= $router->generate('brand-update', ['brand_id' => $brand->getId()]) ?>" class="btn btn-sm btn-warning">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </a>
                                        <!-- Example single danger button -->
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="<?= $router->generate('brand-delete', ['brand_id' => $brand->getId()]).'?token='.$_SESSION['token']  ?>">Oui, je veux supprimer</a>
                                                <a class="dropdown-item" href="#" data-toggle="dropdown">Oups !</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                    <a href="<?= $router->generate('brand-list') ?>" class="btn btn-block btn-success">Voir plus</a>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card text-white mb-3">
                <div class="card-header bg-primary">Liste des types</div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nom</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($typesListForHome as $type) : ?>
                                <tr>
                                    <th scope="row"><?= $type->getId() ?></th>
                                    <td><?= $type->getName() ?></td>
                                    <td class="text-right">
                                        <a href="<?= $router->generate('type-update', ['type_id' => $type->getId()]) ?>" class="btn btn-sm btn-warning">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </a>
                                        <!-- Example single danger button -->
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="<?= $router->generate('type-delete', ['type_id' => $type->getId()]).'?token='.$_SESSION['token'] ?>">Oui, je veux supprimer</a>
                                                <a class="dropdown-item" href="#" data-toggle="dropdown">Oups !</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                    <a href="<?= $router->generate('type-list') ?>" class="btn btn-block btn-success">Voir plus</a>
                </div>
            </div>
        </div>
    </div>
</div>