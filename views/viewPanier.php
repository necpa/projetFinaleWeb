<?php
    // session_start();
    //order_id product_id quantity

?>
<form method="post" action="index.php?url=panier">
    <?php if(count($products) > 0): ?>
        <?php foreach ($products as $product): ?>
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
                                        <p class="card-text"><small class="text-muted"> Quantité : <?= $panierProducts[$product->getId()]['productQty'] ?></small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="col-12 col-lg-2 col-xl-2">
                    <p class="mb-3">Prix unitaire : <?= $product->getPrice(); ?>€</p>
                    <p class="mb-3">Prix total : <?= ($product->getPrice()) * $panierProducts[$product->getId()]['productQty'] ?>€</p>
                </div>
                <div class="col-12 col-lg-2 col-xl-2">
                        <input value="<?= $panierProducts[$product->getId()]['productQty'] ?>" type="number" name="modifierQuantite[<?= $product->getId() ?>]" max="<?= $product->getQuantity()?>" min="0" required>
                        <button type="submit" name="submitQuantite" class="btn btn-primary">Modifier la Quantité</button>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        Le panier est vide
    <?php endif;?>
</form>