<?php
    session_start();
    //order_id product_id quantity
    $_SESSION["panier"]=[263,8,4];
?>

<?php foreach ($products as $product) : ?>
        <?php if ($product->getId()==$_SESSION["panier"][1]) : ?>
            <div class="row">
                <div class="col-12 col-lg-6 col-xl-4">
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="<?= "productimages/".$product->getImage(); ?>" class="img-fluid rounded-start photoPanier" alt="...">

                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $product->getName(); ?></h5>
                                        <p class="card-text"><small class="text-muted"> Quantité : <?= $_SESSION["panier"][2]?></small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="col-12 col-lg-6 col-xl-4">
                    <p class="mb-3">Prix unitaire : <?= $product->getPrice(); ?> €</p>
                    <p class="mb-3">Prix total : <?= ($product->getPrice())*$_SESSION["panier"][2]?>€</p>
                </div>
            </div>
        <?php endif;?>
<?php endforeach; ?>