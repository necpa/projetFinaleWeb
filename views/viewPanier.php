<section class="h-100 h-custom" style="background-color: #eee;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-lg-12">
                                <h5 class="mb-3">
                                    <a href="index.php?url=categories&cat=1" class="text-body">
                                        <i class="fas fa-long-arrow-alt-left me-2"></i> <- Retour sur la boutique
                                    </a>
                                </h5>
                                <?php if ((!isset($_SESSION['is_log']) || !$_SESSION['is_log']) && count($_SESSION["panier"]) > 0): //Si le client n'est pas log on le conseille de se connecter ?>
                                    <a href="index.php?url=connexion" class="text-body">
                                        Cliquez ici pour vous <strong>connecter</strong>, cela simplifiera la finalisation de votre commande
                                    </a>
                                <?php endif;?>
                                <hr>
                                <form method="post" action="index.php?url=panier">
                                    <?php if(count($products) > 0): ?>
                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                            <div>
                                                <p class="mb-1">Votre panier :
                                                    <?php
                                                    if(isset($_SESSION["panier"])){
                                                        if($_SESSION["panier"]!=[]){
                                                            echo "(" . count($_SESSION["panier"]) . " article" . (count($_SESSION["panier"]) > 1 ? "s" : "") . ")";
                                                        }
                                                    }
                                                    ?>
                                                </p>
                                            </div>
                                        </div>
                                        <?php foreach ($products as $product): ?>
                                            <div class="row">
                                                <div class="col-12 col-lg-10 col-xl-10">
                                                    <div class="card mb-3">
                                                        <div class="row g-0">
                                                            <div class="col-md-2">
                                                                <a href="index.php?url=products&id=<?=$product->getId()?>"><!-- On met le lien du produit sur le nom et l'image-->
                                                                    <img src="<?= "productimages/".$product->getImage(); ?>" class="img-fluid rounded-start photoPanier" alt="...">
                                                                </a>
                                                            </div>
                                                            <div class="col-md-10">
                                                                <div class="card-body row">
                                                                    <div class="col-lg-6 col-xl-6">
                                                                        <a href="index.php?url=products&id=<?=$product->getId()?>"> <!-- On met le lien du produit sur le nom et l'image-->
                                                                            <h5 class="card-title"><?= $product->getName(); ?></h5>
                                                                        </a>
                                                                        <p class="card-text"><small class="text-muted"> Quantit?? : <?= $panierProducts[$product->getId()]['productQty'] ?></small></p>
                                                                    </div>
                                                                    <div class="col-12 col-lg-3 col-xl-3">
                                                                        <input value="<?= $panierProducts[$product->getId()]['productQty'] ?>" type="number" name="modifierQuantite[<?= $product->getId() ?>]" max="<?= $product->getQuantity()?>" min="0" required>
                                                                        <button type="submit" name="suprQuantite" class="mb-1 btn-sm btn btn-danger">X</button>
                                                                        <button type="submit" name="submitQuantite" class="btn btn-secondary">Modifier la Quantit??</button>
                                                                    </div>
                                                                    <div class="col-12 col-lg-3 col-xl-3">
                                                                        <p class="mb-3">Prix unitaire : <?= $product->getPrice(); ?>???</p>
                                                                        <p class="mb-3">Prix total : <?= ($product->getPrice()) * $panierProducts[$product->getId()]['productQty'] ?>???</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        <?php endforeach; ?>
                                    <div class="row">
                                        <div class="card col-12 col-lg-3 col-xl-3">
                                            <p class="text-center m-0">Prix total : <?php echo($_SESSION["prixTotal"])?> ???</p>
                                        </div>
                                        <a href="index.php?url=adresse" class="col-12 col-lg-3 col-xl-3"><strong>??tape suivante</strong></a>
                                    </div>
                                    <?php else: ?>
                                        Le panier est vide
                                    <?php endif;?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>