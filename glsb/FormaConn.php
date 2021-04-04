<?php if (!isset($_SESSION['pseudo'])) { ?>
<div>
		<form method="post" action="<?php echo BASE_URL . 'Connexion.php'; ?>" >
			<h3>Connexion​</h3>
			<?php include(ROOT_PATH . '/errors.php') ?>
			            Pseudo :<input type="text" name="pseudo"  ></br><br>
			             Mot de Passe :<input type="password" name="password"></br><br>
						 Connexion automatique<input type="checkbox" name="remember_me" /></br></br>
			              <button name="Conn_btn">Connexion</button></br></br></br>
			<div style="background-color:#a94442;display:inline-flex;" >
				<div>
					 Si vous n'avez pas de compte,<br> vous pouvez créer votre compte</br></br>
				</div>
				<div> 
					<button><a href="Inscription.php">créer un compte</a></button></br>
			    </div>
			</div>
</form>
<?php }else{ header("location: Index.php"); }?>