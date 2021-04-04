<?php if (isset($_SESSION['pseudo'])) { ?>
	<div>
		<span>Salut <?php echo $_SESSION['pseudo'] ?>. Nous sommes à votre service pour faciliter votre travail.</span>
		<p>Gestion des livres et des services de bibliothèque de Collège belfaa</p>
	</div>
<?php }else{ ?>
	<h1 style='background-color:#C71585;padding-left:3em;'>Gestion des livres et des services de bibliothèque de Collège belfaa</h1>
	<div style='display:inline-flex;'>
		<div style='background-color:rgba(173,255,47,0.1);border-radius:20px;border:0.3em solid #FFD700;margin:1em 1em 1em 1em;padding:1em;'>
			<p> Vous pouvez ouvrir votre compte ici<br>
			    Nous sommes à votre service pour<br> faciliter votre travail <br>
			    Nous vous conseillons de ne pas<br> ouvrir de nombreux comptes si vous<br>êtes le seul admin de la bibliothèque.<br>
				<span>Dépêchez-vous de vous inscrire sur le site</span>
			</p>
			<a href="Inscription.php" style='color:#FFD700;'>Inscription ICI</a>
		</div>

		<div style='background-color:rgba(173,255,47,0.1);border-radius:20px;border:0.3em solid #FF8C00;margin:1em 1em 1em 1em;padding:1em;'>
			<form action="<?php echo BASE_URL . 'index.php'; ?>" method="post" >
				<h2>Connexion</h2>
				<div>
					<?php include(ROOT_PATH . '/errors.php') ?>
				</div>
				Pseudo :<input style='background-color:#8B0000;color:;width:16em;height:2em;border-radius:5px;border:0.1em solid #7FFF00;' type="text" name="pseudo" value="<?php echo $pseudo; ?>" value="" placeholder="Pseudo" ><br><br>
			    Mot de Passe :<input style='background-color:#8B0000;color:;width:16em;height:2em;border-radius:5px;border:0.1em solid #7FFF00;' type="password" name="password" placeholder="Password"><br><br>
			    Connexion automatique<input style="background-color:#7FFF00;width:1em;height:1em;" type="checkbox" name="remember_me" /><br><br>
			<button name="Conn_btn" style='background-color:#FF7F50;width:10em;height:3em;border-radius:10px;font-weight:bold;border:0.2em solid #7FFF00;margin-left:20em;'>Connexion</button>
			</form>
		</div>
	</div>
<?php } ?>
