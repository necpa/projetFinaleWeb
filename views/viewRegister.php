<form class="box" action="" method="post">
    <h1 class="box-title">S'inscrire</h1>
	<input type="text" class="box-input" name="username" placeholder="Nom d'utilisateur" required />
    <input type="password" class="box-input" name="password" placeholder="Mot de passe" required />
    <input type="submit" name="submit" value="S'inscrire" class="box-button" />
    <p class="box-register">Déjà inscrit? <a href="index.php?url=connexion">Connectez-vous ici</a></p>
</form>
<?php
if (isset($usernameAlreadyExists))
{
?>
    <label class="RegisterError">Le nom d'utilisateur a déjà été utilisé !</label>
<?php
}
?>