<div class="container my-4">
    <a href="<?= $router->generate('product-list'); ?>" class="btn btn-success float-right">Retour</a>
    <h2><?= isset($product) ? 'Modifier' : 'Ajouter' ?> un produit</h2>
    
    <form action="<?= isset($product) ? $router->generate('product-update', ['product_id' => $product->getId()]) : $router->generate('product-create') ?>" method="POST" class="mt-5">
        <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
        <div class="form-group">
            <label for="name">Nom</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nom de la catégorie" value="<?= isset($product) ? $product->getName() : '' ?>">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" id="description" name="description" placeholder="Description" aria-describedby="descriptionHelpBlock" value="<?= isset($product) ? $product->getDescription() : '' ?>">
            <small id="subtitleHelpBlock" class="form-text text-muted">
                La description du produit 
            </small>
        </div>
        <div class="form-group">
            <label for="picture">Image</label>
            <input type="text" class="form-control" id="picture" name="picture" placeholder="image jpg, gif, svg, png" aria-describedby="pictureHelpBlock" value="<?= isset($product) ? $product->getPicture() : '' ?>">
            <small id="pictureHelpBlock" class="form-text text-muted">
                URL relative d'une image (jpg, gif, svg ou png) depuis la racine
            </small>
        </div>
        <div class="form-group">
            <label for="price">Prix</label>
            <input type="number" class="form-control" id="price" name="price" placeholder="Prix" aria-describedby="priceHelpBlock" value="<?= isset($product) ? $product->getPrice() : '' ?>">
            <small id="priceHelpBlock" class="form-text text-muted">
                Le prix du produit 
            </small>
        </div>
        <div class="form-group">
            <label for="rate">Note</label>
            <input type="text" class="form-control" id="rate" name="rate" placeholder="Note" aria-describedby="rateHelpBlock" value="<?= isset($product) ? $product->getRate() : '' ?>">
            <small id="rateHelpBlock" class="form-text text-muted">
                Le note du produit 
            </small>
        </div>
        <div class="form-group">
            <label for="status">Statut</label>
            <select class="custom-select" id="status" name="status" aria-describedby="statusHelpBlock">
                <option value="2" <?php if(isset($product) && $product->getStatus() == 2) : ?> selected <?php endif ?>>Inactif</option>
                <option value="1" <?php if(isset($product) && $product->getStatus() == 1) : ?> selected <?php endif ?>>Actif</option>
            </select>
            <small id="statusHelpBlock" class="form-text text-muted">
                Le statut du produit 
            </small>
        </div>
        <div class="form-group">
            <label for="category">Catégorie</label>
            <select class="custom-select" id="category" name="category_id" aria-describedby="categoryHelpBlock">
                    <option value="0">Aucune Catégorie</option>
                <?php foreach($category as $categoryProduct) : ?>
                    <option value="<?= $categoryProduct->getId() ?>" <?php if(isset($product) && $product->getCategoryId() == $categoryProduct->getId() ) : ?> selected <?php endif ?>>
                        <?= $categoryProduct->getName() ?>
                    </option>
                <?php endforeach ?>
            </select>
            <small id="categoryHelpBlock" class="form-text text-muted">
                La catégorie du produit 
            </small>
        </div>
        <div class="form-group">
            <label for="brand">Marque</label>
            <select  class="custom-select" id="brand" name="brand_id" aria-describedby="brandHelpBlock">
                <?php foreach($brands as $brandProduct) : ?>
                    <option value="<?= $brandProduct->getId() ?>" <?php if(isset($product) && $product->getBrandId() == $brandProduct->getId() ) : ?> selected <?php endif ?>>
                        <?= $brandProduct->getName() ?>
                    </option>
                <?php endforeach ?>
            </select>
            <small id="brandHelpBlock" class="form-text text-muted">
                La marque du produit 
            </small>
        </div>
        <div class="form-group">
            <label for="type">Type</label>
            <select class="custom-select" id="type" name="type_id" aria-describedby="typeHelpBlock">
                <?php foreach($types as $typeProduct) : ?>
                    <option value="<?= $typeProduct->getId() ?>" <?php if(isset($product) && $product->getTypeId() == $typeProduct->getId() ) : ?> selected <?php endif ?>>
                        <?= $typeProduct->getName() ?>
                    </option>
                <?php endforeach ?>
            </select>
            <small id="typeHelpBlock" class="form-text text-muted">
                Le type de produit 
            </small>
        </div>
        <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
    </form>
</div>