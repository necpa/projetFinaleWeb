
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
    <h1>Commentaires :</h1>
    <?php foreach ($reviews as $review) : ?>

            <div class="commentaire">
                <div>
                    <img class="photoProfil ligne" src="productimages/<?php echo($review->getPhotoUser())?>">
                    <b><p class="ligne color-white"><?= $review->getNameUser()?> :</p></b>
                    <p class="ligne"><?= $review->getTitle()?></p>

                    <?php for ($i=0; $i < $review->getStars(); $i++): ?>
                        <img class="etoile" src="productimages/review_star.png">
                    <?php endfor; ?>
                    <?php for ($i=5; $i > $review->getStars(); $i--): ?>
                        <img class="etoile" src="productimages/review_gray.png">
                    <?php endfor; ?>

                </div>

                <?= $review->getDescription()?>

            </div>
    <?php endforeach; ?>
