<section>
    <div class="container-fluid">
        <div class="row mx-0">
            <?php foreach ($categories as $index => $category) : ?>
                <?php if ($index < 2) : ?>
                    <div class="col-md-6">
                        <div class="card border-0 text-white text-center">
                            <img src="<?= $category->getPicture(); ?>" alt="Card image" class="card-img">
                            <div class="card-img-overlay d-flex align-items-center">
                                <div class="w-100 py-3">
                                    <h2 class="display-3 font-weight-bold mb-4">
                                        <?= $category->getName(); ?>
                                    </h2>
                                    <a href="<?= $router->generate("oshop-catalog-category", ["category_id" => $category->getID()]) ?>" class="btn btn-light">
                                        <?= $category->getSubtitle(); ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="col-lg-4">
                        <div class="card border-0 text-center text-white">
                            <img src="<?= $category->getPicture(); ?>" alt="Card image" class="card-img">
                            <div class="card-img-overlay d-flex align-items-center">
                                <div class="w-100">
                                    <h2 class="display-4 mb-4">
                                        <?= $category->getName(); ?>
                                    </h2>
                                    <a href="<?= $router->generate("oshop-catalog-category", ["category_id" => $category->getID()]) ?>" class="btn btn-link text-white">
                                        <?= $category->getSubtitle(); ?>
                                        <i class="fa-arrow-right fa ml-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>