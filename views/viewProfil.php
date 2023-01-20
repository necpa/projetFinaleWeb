<div class="card align-middle" style="width: 30rem;">
    <div class="card-header">
        <span>Vos informations personelles : </span>
    </div>
    <form method="post" action="index.php?url=profil">
        <ul class="list-group list-group-flush">

            <li class="list-group-item">Prénom :
                <input type="text" name="forname" value="<?= $customer->getForname(); ?>">
            </li>
            <li class="list-group-item">Nom :
                <input type="text" name="surname" value="<?= $customer->getSurname(); ?>">
            </li>
            <li class="list-group-item">Adresse 1 :
                <input type="text" name="addone" value="<?= $customer->getAdd1(); ?>">
            </li>
            <li class="list-group-item">Complément d'adresse :
                <input type="text" name="addtwo" value="<?= $customer->getAdd2(); ?>">
            </li>
            <li class="list-group-item">Ville :
                <input type="text" name="addthree" value="<?= $customer->getAdd3(); ?>">
            </li>
            <li class="list-group-item">Code Postal :
                <input type="text" name="postcode" value="<?= $customer->getPostcode(); ?>">
            </li>
            <li class="list-group-item">Téléphone :
                <input type="tel" name="phone" value="<?= $customer->getPhone(); ?>">
            </li>
            <li class="list-group-item">Email :
                <input type="text" name="email" value="<?= $customer->getEmail(); ?>">
            </li>
            <li class="list-group-item">
                <button type="submit" name="modifyCustomer" class="btn btn-secondary">Enregistrer</button>
            </li>
        </ul>
    </form>
</div>
