<section class="h-100 h-custom" style="background-color : #eee;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col">
                <?php if(isset($customer)) : ?>
                <div class="card">
                    <div class="card-body p-4">
                        <h5 class="mb-3">Choisissez vos informations de livraison :</h5>
                        <hr>
                        <form method="post" action="index.php?url=adresse">
                            <!-- Si il toutes les infos du profil sont remplies, on affiche le choix entre ces infos ou en rentrer des nouvelles -->
                            <?php if ($customer->getSurname() != "" && $customer->getForname() != "" && $customer->getEmail() != "" && $customer->getPhone() != "" && $customer->getPostcode() != "" && $customer->getAdd1() != "" && $customer->getAdd3() != ""):?>
                            <div class="card mb-3">
                                <div class="card-body p-2">
                                    <div class="row d-flex justify-content-center">
                                        <h5 class="mb-3">Information de livraison enregistré</h5>
                                    </div>
                                    <div class="row">
                                        <div class="col-1 d-flex justify-content-center">
                                            <input type="radio" name="customer_address" value="0" required>
                                        </div>
                                        <div class="col">
                                                <div class="row pb-1">
                                                    <div class="col-2">
                                                        <input class="form-control" type="text" value='<?php echo $customer->getSurname();?>' aria-label="<?php echo $customer->getSurname();?>" disabled readonly>
                                                    </div>
                                                    <div class="col-2">
                                                        <input class="form-control" type="text" value='<?php echo $customer->getForname();?>' aria-label='<?php echo $customer->getForname();?>' disabled readonly>
                                                    </div>
                                                </div>
                                                <div class="row pb-1">
                                                    <div class="col-3">
                                                        <input class="form-control" type="text" value='<?php echo $customer->getEmail();?>' aria-label='<?php echo $customer->getEmail();?>' disabled readonly>
                                                    </div>
                                                    <div class="col-3">
                                                        <input class="form-control" type="text" value='<?php echo $customer->getPhone();?>' aria-label='<?php echo $customer->getPhone();?>' disabled readonly>
                                                    </div>
                                                </div>
                                                <div class="row pb-1">
                                                    <div class="col-8">
                                                        <input class="form-control" type="text" value='<?php echo $customer->getAdd1();?>' disabled readonly>
                                                    </div>
                                                </div>
                                                <div class="row pb-1">
                                                    <div class="col-8">
                                                        <input class="form-control" type="text" value='<?php echo $customer->getAdd2();?>'  disabled readonly>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-2">
                                                        <input class="form-control" type="text" value="<?php echo $customer->getAdd3();?>" disabled readonly>
                                                    </div>
                                                    <div class="col-2">
                                                        <input class="form-control" type="text" value="<?php echo $customer->getPostcode();?>" aria-label='<?php echo $customer->getPostcode();?>' disabled readonly>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endif;?>
                            <a href="index.php?url=profil"><small>Pour vos prochaines commandes, vous pouvez renseigner vos informations dans la section "profil" afin de passer cette étape.</small></a>
                            <div class="card mb-3">
                                <div class="card-body p-2">
                                <h5 class="mb-3">Autres informations de livraison</h5>
                                    <div class="row">
                                        <div class="col-1 d-flex justify-content-center">
                                            <input type="radio" name="customer_address" value="1" required>
                                        </div>
                                        <div class="col">
                                                <div class="row pb-1">
                                                    <div class="col-2">
                                                        <div class="form-floating mb-1">
                                                            <input type="text" class="form-control" id="floatingInputNom" name="nom" placeholder="Nom">
                                                            <label for="floatingInputNom">Nom</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="form-floating mb-1">
                                                            <input type="text" class="form-control" id="floatingInputPrenom" name="prenom" placeholder="Prenom">
                                                            <label for="floatingInputPrenom">Prenom</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row pb-1">
                                                    <div class="col-3">
                                                        <div class="form-floating mb-1">
                                                            <input type="email" class="form-control" id="floatingInputEmail" name="email" placeholder="email">
                                                            <label for="floatingInputEmail">Adresse e-mail</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="form-floating mb-1">
                                                            <input type="text" class="form-control" id="floatingInputPhone" name="phone" placeholder="Phone">
                                                            <label for="floatingInputPhone">Numéro de téléphone</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row pb-1">
                                                    <div class="col-8">
                                                        <div class="form-floating mb-1">
                                                            <input type="text" class="form-control" id="floatingInputAdd1" name="add1" placeholder="Add1">
                                                            <label for="floatingInputAdd1">Adresse</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row pb-1">
                                                    <div class="col-8">
                                                        <div class="form-floating mb-1">
                                                            <input type="text" class="form-control" id="floatingInputAdd2" name="add2" placeholder="Add2">
                                                            <label for="floatingInputAdd2">Complément d'adresse</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-2">
                                                        <div class="form-floating mb-1">
                                                            <input type="text" class="form-control" id="floatingInputAdd3" name="add3" placeholder="Add3">
                                                            <label for="floatingInputAdd3">Ville</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control" id="floatingInputPostcode" name="postcode" placeholder="Postcode">
                                                            <label for="floatingInputPostcode">Code postale</label>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-2">
                                    <button type="submit" name="submitChoixAdresse" class="btn btn-primary bg-info bg-gradient">Payer</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <?php else : ?>
                    <div class="card">
                        <div class="card-body p-4">
                            <h5 class="mb-3">Rentrez vos informations de livraison :</h5>
                            <hr>
                            <form method="post" action="index.php?url=adresse">
                                    <div class="row">
                                        <div class="col">
                                                <div class="row pb-1">
                                                    <div class="col-2">
                                                        <div class="form-floating mb-1">
                                                            <input type="text" class="form-control" id="floatingInputNom" name="nom" placeholder="Nom" required>
                                                            <label for="floatingInputNom">Nom</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="form-floating mb-1">
                                                            <input type="text" class="form-control" id="floatingInputPrenom" name="prenom" placeholder="Prenom" required>
                                                            <label for="floatingInputPrenom">Prenom</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row pb-1">
                                                    <div class="col-3">
                                                        <div class="form-floating mb-1">
                                                            <input type="email" class="form-control" id="floatingInputEmail" name="email" placeholder="email" required>
                                                            <label for="floatingInputEmail">Adresse e-mail</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="form-floating mb-1">
                                                            <input type="text" class="form-control" id="floatingInputPhone" name="phone" placeholder="Phone" required>
                                                            <label for="floatingInputPhone">Numéro de téléphone</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row pb-1">
                                                    <div class="col-8">
                                                        <div class="form-floating mb-1">
                                                            <input type="text" class="form-control" id="floatingInputAdd1" name="add1" placeholder="Add1" required>
                                                            <label for="floatingInputAdd1">Adresse</label>
                                                        </div>                                                
                                                    </div>
                                                </div>
                                                <div class="row pb-1">
                                                    <div class="col-8">
                                                        <div class="form-floating mb-1">
                                                            <input type="text" class="form-control" id="floatingInputAdd2" name="add2" placeholder="Add2">
                                                            <label for="floatingInputAdd2">Complément d'adresse</label>
                                                        </div>                                                
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-2">
                                                        <div class="form-floating mb-1">
                                                            <input type="text" class="form-control" id="floatingInputAdd3" name="add3" placeholder="Add3" required>
                                                            <label for="floatingInputAdd3">Ville</label>
                                                        </div>  
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control" id="floatingInputPostcode" name="postcode" placeholder="Postcode" required>
                                                            <label for="floatingInputPostcode">Code postale</label>
                                                        </div>  
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-end m-4">
                                    <div class="col-2">
                                        <button type="submit" name="submitNewAdresse" class="btn btn-primary bg-info bg-gradient">Payer</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>