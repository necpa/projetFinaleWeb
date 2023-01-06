<h1>Nos <?= $category->getName();?> :</h1>
<div class="row">
    <?php foreach ($products as $product) : ?>
        <div class="col-12 col-lg-6 col-xl-4">
            <a href="index.php?url=commentaires&id=<?php echo($product->getId())?>">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="<?= "productimages/".$product->getImage(); ?>" class="img-fluid rounded-start" alt="...">

                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?= $product->getName(); ?></h5>
                                <p class="card-text"><?= $product->getDescription(); ?></p>
                                <p class="card-text"><small class="text-muted">Notre prix : <?= $product->getPrice(); ?> €</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>



            <div class="row d-none">
                <div class="col-md-2">
                    <a href="index.php?url=commentaires&id=<?php echo($product->getId())?>"><img class="image-product" src=<?= "productimages/".$product->getImage(); ?>></a>
                </div>
                <div class ="col-md-8">
                    <a href="index.php?url=commentaires&id=<?php echo($product->getId())?>"><h1 class="color-white"><?= $product->getName(); ?></h1></a>
                    <p><?= $product->getDescription(); ?></p>
                    <h3>Notre prix : <?= $product->getPrice(); ?> €</h3>
                    <form>
                        <button type="button" data-button-action="add-to-cart" type="submit">Ajouter au panier</button>
                        <input type="number" min=0 id="<?php echo($product->getId()) ?>" placeholder="Quantité">
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>