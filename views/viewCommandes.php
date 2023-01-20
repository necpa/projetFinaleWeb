<?php if (isset($orders)) : ?>
    <?php if (count($orders) > 0) : ?>
        <h3>Bonjour <?=$_SESSION['username']?>, voici l'historique de vos commandes</h3>
        <?php foreach ($orders as $order):?>
            <div class="row">
                <div class="card col-md-6" style="max-width: 700px;">
                    <div class="card-body ">
                        <p class="card-title">
                            <strong>Numéro de commande : </strong><span><?= $order->getId(); ?></span>
                            <span>|<strong> Date :  </strong><?= $order->getDate(); ?></span>
                            <span>|<strong> Prix :  </strong><?= $order->getTotal(); ?>€</span>
                            <?php if($order->getStatus() == 0) :?>
                                <span>| Status : Panier en cours</span>
                            <?php endif; ?>
                            <?php if($order->getStatus() == 1) :?>
                                <span>|<strong> Status :</strong> Adresse renseignée</span>
                            <?php endif; ?>
                            <?php if($order->getStatus() == 2) :?>
                                <span>|<strong> Status :</strong> Payée</span>
                            <?php endif; ?>
                            <?php if($order->getStatus() == 10) :?>
                                <span>|<strong> Status :</strong> Envoyée</span>
                            <?php endif; ?>
                        </p>
                        <!-- On parcours tout les items -->
                        <?php for($i=0; $i <= count($items[$order->getId()])-1; $i++):?>
                            <p class="card-text"><?= $items[$order->getId()][$i]->getQuantity(); ?> x <?= $products[$items[$order->getId()][$i]->getProductId()]->getName(); ?></p>
                        <?php endfor; ?>
                        <strong><a href="index.php?url=facture&order=<?=$order->getId()?>">Obtenir facture</a></strong>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
    <?php else:?>
        <h3>Bonjour <?=$_SESSION['username']?>, vous n'avez pas encore commandé chez nous !</h3>
    <?php endif;?>

<?php else:?>
    <h3>Bonjour <?=$_SESSION['username']?>, vous n'avez pas encore commandé chez nous !</h3>
<?php endif;?>