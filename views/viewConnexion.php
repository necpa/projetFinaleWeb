<form class="box" action="" method="post">
    <h1 class="box-title">Connexion</h1>
	<input type="text" class="box-input" name="username" placeholder="Nom d'utilisateur" required />
    <input type="password" class="box-input" name="password" placeholder="Mot de passe" required />
    <input type="submit" name="submit" value="Connexion" class="box-button" />
    <p class="box-register">Pas de compte ?<a href="index.php?url=register">Enregistrez-vous içi</a></p>
</form>

<?php
if (isset($is_log))
{?>
	<label class="loginError">Le nom d'utilisateur ou le mot de passe est incorrecte</label>
<?php } ?>