<?php if (!isset($_SESSION["payment_type"])) :?> <!-- Si le mode de paiment n'est pas renseigné on affiche le choix-->

    <div class="containerr">
        <div class="row">
            <div class="col-lg-6 mb-lg-0 mb-3">
                <div class="card p-3">
                    <div class="img-boxx">
                        <img src="productimages/paypal.png" alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-lg-0 mb-3">
                <div class="card p-3">
                    <div class="img-boxx">
                        <img src="productimages/cheque.jpg" alt="">
                    </div>
                </div>
            </div>
            <div class="col-12 mt-4">
                <div class="card p-3">
                    <p class="mb-0 fw-bold h4">Payment Methods</p>
                </div>
            </div>
            <div class="col-12">
                <div class="card p-3">
                    <div class="card-body border p-0">
                        <p>
                            <a class="btn btn-primary w-100 h-100 d-flex align-items-center justify-content-between"
                               data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="true"
                               aria-controls="collapseExample">
                                <span class="fw-bold">PayPal</span>
                                <span class="fab fa-cc-paypal">
                                    </span>
                            </a>
                        </p>
                        <div class="collapse p-3 pt-0" id="collapseExample">
                            <div class="row mb-2">
                                <div class="col-8">
                                    <p class="h4 mb-0"><strong>Récapitulatif :</strong></p>
                                    <p class="mb-0">
                                        <?php
                                            echo(count($_SESSION["panier"]) . " ");
                                            if (count($_SESSION["panier"]) == 1){
                                                echo("produit");
                                            }
                                            else{
                                                echo("produits");
                                            }
                                        ?>
                                    </p>
                                    <p class="mb-0"><span class="fw-bold">Prix:</span>
                                        <span class="c-green"> <?= $_SESSION["prixTotal"]?> €</span>
                                    </p>
                            </div>
                            <div>
                                <a>
                                    <form method="post" action="index.php?url=paiment">
                                        <button type="submit" name="paimentPaypal" class="btn btn-success">Payer</button>
                                    </form>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body border p-0">
                        <p>
                            <a class="btn btn-primary w-100 h-100 d-flex align-items-center justify-content-between"
                               data-bs-toggle="collapse" href="#collapseCheque" role="button" aria-expanded="true"
                               aria-controls="collapseCheque">
                                <span class="fw-bold">Chèque</span>
                                <span class="fab fa-cc-paypal"></span>
                            </a>
                        </p>
                        <div class="collapse p-3 pt-0" id="collapseCheque">
                            <div class="row mb-2">
                                <div class="col-8">
                                    <p class="h4 mb-0"><strong>Récapitulatif :</strong></p>
                                    <p class="mb-0">
                                        <?php
                                            echo(count($_SESSION["panier"]) . " ");
                                            if (count($_SESSION["panier"]) == 1){
                                                echo("produit");
                                            }
                                            else{
                                                echo("produits");
                                            }
                                        ?>
                                    </p>
                                    <p class="mb-0"><span class="fw-bold">Prix:</span>
                                        <span class="c-green"> <?= $_SESSION["prixTotal"]?> €</span>
                                    </p>
                                </div>
                            </div>
                            <div>
                                <a>
                                    <form method="post" action="index.php?url=paiment">
                                        <button type="submit" name="paimentCheque" class="btn btn-success">Payer</button>
                                    </form>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else :?> <!-- Si le mode de paiment est validé on affiche la confimation-->
    <?php if(!isset($_SESSION["confirm_payment"]) || !$_SESSION["confirm_payment"]) :?>
        <form action="index.php?url=paiment" method="post" class="mb-3">
            <button type="submit" name="retourPaiment" class="btn btn-warning">Changer de moyen de paiment</button>
        </form>
        <form action="index.php?url=paiment" method="post" class="mb-3">
            <button type="submit" name="validerCommande" class="btn btn-success">Valider la commande</button>
        </form>
    <?php endif;?>
<?php endif;?>
        <?php if(isset($_SESSION["confirm_payment"]) && isset($_SESSION["payment_type"])) :?>
        <?php if($_SESSION["payment_type"] =="cheque") :?>
            <?php if($_SESSION["confirm_payment"]) :?>
                <div class="card mb-3">
                    <h5 class="card-header">Vous avez choisi de régler par <strong>chèque</strong></h5>
                    <div class="card-body">
                        <p class="mb-3">Votre commande est confirmée, veuillez nous envoyer un chèque de <?= $_SESSION["prixTotal"] ?>€ à l'ordre "Web4Shop" à l'adresse suivante :</p>
                        WEB4SHOP<br>
                        13 chemin du biscuit<br>
                        69006<br>
                        Lyon</p>
                        <p>Votre commande sera expediée lors de la récéption de votre paiment.</p>
                    </div>
                </div>
                <a href="facture.php">
                    <p>
                        Cliquez <strong>ici</strong> pour obtenir votre facture
                    </p>
                </a>
                    <?php unset($_SESSION["confirm_payment"]) ;
                    unset($_SESSION["payment_type"]);
                    ?>
            <?php endif;?>
        <?php endif;?>
    <?php endif;?>
    <?php if(isset($_SESSION["confirm_payment"]) && isset($_SESSION["payment_type"])) :?>
        <?php if($_SESSION["payment_type"] =="paypal") :?>
            <?php if($_SESSION["confirm_payment"]) :?>
                <div class="card mb-3">
                    <p class="card-body">Vous avez choisi de régler via <strong>PayPal</strong></p>
                    <p class="card-body">Votre commande est confirmée, elle sera expédiée très prochainement.</p>
                </div>
                <a href="facture.php">
                    <p>
                        Cliquez <strong>ici</strong> pour obtenir votre facture
                    </p>
                </a>
            <!-- Attention à bien mettre le moyen de paiment dans la bd avant d'unset-->
                <?php unset($_SESSION["confirm_payment"]) ;
                unset($_SESSION["payment_type"]);
                ?>
            <?php endif;?>
        <?php endif;?>
    <?php endif;?>

