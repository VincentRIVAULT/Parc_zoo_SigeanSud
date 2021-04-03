
<section id="login">
	<h2><i class="fas fa-sign-in-alt"></i> connectez-vous</h2>
	<form method="POST" action="index.php?controller=securite&action=login">
		<ul>
			<li>
				<label for="identifiant" class="required">Identifiant* :</label>
				<input type="text" id="identifiant" name="identifiant" autofocus required/>
				<span class="error">Champ invalide</span>
			</li>
			<li>
				<label for="mdp" class="required">Mot de passe* :</label>
				<input type="password" id="mdp" name="mdp" />
				<span class="error">Champ invalide</span>
			</li>
			<li>
				<label for=""></label>
				<input type="submit" id="connexion" name="connexion" value="Se connecter"/>
			</li>
			<p><small class="required">* Champ obligatoire</small></p>
		</ul>
	</form>
</section>
