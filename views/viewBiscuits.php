<?php foreach ($products as $product) : ?>
    <?php if ($product->getCatId() == 2) : ?>
        <div class="row">
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
    <?php endif; ?>
<?php endforeach; ?>
