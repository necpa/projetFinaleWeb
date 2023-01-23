<div class="row">
    <div class="card col-md-6" style="max-width: 700px;">
        <div class="card-body ">
            <p class="card-title">
                <strong>Numéro de commande : </strong><span><?= $order->getId(); ?></span>
                <span>|<strong> Date :  </strong><?= $order->getDate(); ?></span>
                <span>|<strong> Prix :  </strong><?= $order->getTotal(); ?>€</span>
            </p>
            <!-- On parcours tout les items -->
            <br>
            <div class="row">
                <strong> Produits : </strong>
                </br>
                <?php foreach($items as $item):?>
                    <p class="card-text"><?= $item->getQuantity(); ?> x <?= ($products[$item->getProductId()])->getName(); ?></p>
                <?php endforeach; ?>
            </div>
            <br>
            <div class="row">
                <strong> Information de livraison : </strong>
                <div class="row">
                    <div class="col-3">
                        <label><strong>Nom : </strong><?php echo($deliveryAddresse->getLastname()." "); ?></label>
                    </div>
                    <div class="col-3">
                        <label><strong>Prénom : </strong><?php echo$deliveryAddresse->getFirstname(); ?></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <label><strong>adresse : </strong> <?php echo$deliveryAddresse->getAdd1(); ?></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <label><strong> complément d'adresse : </strong> <?php echo$deliveryAddresse->getAdd2(); ?></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <label><strong> Ville : </strong> <?php echo$deliveryAddresse->getCity(); ?></label>
                    </div>
                    <div class="col-4">
                        <label><strong>Code Postale : </strong><?php echo$deliveryAddresse->getPostcode(); ?></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <label><strong>Numéro de téléphone : </strong><?php echo$deliveryAddresse->getPhone(); ?></label>
                    </div>
                </div>
            </div>
            <form method="post" action="index.php?url=commandes&order=<?= $order->getId(); ?>">
                <button type="submit" name="submitEnvoie" class="btn btn-primary">Commande envoyé</button>
            </form>
        </div>
    </div>
</div>