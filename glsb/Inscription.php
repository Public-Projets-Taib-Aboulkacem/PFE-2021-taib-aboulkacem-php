<?php  include('Config.php'); ?>
<?php require('init.php');?>
<?php  include('hautpage.php'); ?>
	<title>Page d'inscription </title>
</head>
<body>
<?php
/*dons le page connecxion et inscription*/
	if(isset($_SESSION['pseudo'])) {
		header("location: Index.php");
	}else{
?>
   <?php include( ROOT_PATH . '/menu.php'); ?>
   <div style='background-color:#060c21;color:#7FFF00;padding:1em 2em 1em 2em;font-size:30px;text-align:center;' >
<?php 
	$pseudo = "";
	$email    = "";
	$password_1= "";
	$password_2= "";
	$errors = array(); 

	// REGISTER USER
    if(isset($_POST['btn_Insc'])){
			$pseudo =$_POST['pseudo'];
		    $email = $_POST['email'];
		    $password_1 = $_POST['password_1'];
		    $password_2 =$_POST['password_2'];
			if (empty($pseudo)) {  array_push($errors, "Vous devez entrer votre Pseudo"); }
		    if (empty($email)) { array_push($errors, "Vous devez entrer votre email"); }
		    if (empty($password_1)) { array_push($errors, "Vous devez entrer votre Password"); }
		    if ($password_1 != $password_2) { array_push($errors, "votre password ne pas correcte");}
		    $user_exists = "SELECT * FROM glsb.users WHERE pseudo='$pseudo' OR email='$email' LIMIT 1";

		    $result = mysqli_query($con, $user_exists);
		    $user = mysqli_fetch_assoc($result);
		if ($user) { // if user exists
			   if ($user['pseudo'] === $pseudo) {
			     array_push($errors, "Ce pseudo existe déjà");
		     	}
			   if ($user['email'] === $email) {
			     array_push($errors, "Ce email existe déjà");
			   }
			}
		if (count($errors) == 0) {
				$password = password_hash($password_1,PASSWORD_BCRYPT);
			    $query = "INSERT INTO glsb.users (pseudo,pass,email,date_inscription) VALUES ('$pseudo','$password','$email',now())";
				$req=mysqli_query($con, $query);
				if($req){
			    $_SESSION['pseudo']=$_POST['pseudo'];
                $_SESSION['email']=$_POST['email'];
				header('location: index.php');
				}else{
					array_push($errors, "Aucune modification n'a été apportée. Il y a un bogue dans le programme");
				}
			  
		    }
	    }
	?>
	 <div>
	 <h3>Inscription</h3>
	 <?php include(ROOT_PATH . '/errors.php') ?>
	 <form method="post" action="Inscription.php" >
	   Pseudo :<input type="text" name="pseudo" ></br>
	   Mot de Passe :<input type="password" name="password_1" ></br>
	   Retapez votre mot de passe :<input type="password" name="password_2" ></br>
	   Adresse email :<input type="text" name="email" value="email.general.com" ></br></br>
	  <button name="btn_Insc" >Inscription</button></br></br></br>
	        <div style="background-color:#a94442;display:inline-flex;" >
	        	<div>
	        		Vous avez un compte, vous pouvez vous connecter ici</br></br>
	        	</div>
	        	<div>
	        		</br></br><button><a href="Connexion.php">Connexion</a></button></br>
	        	</div>
	        </div>
	  </form>
	  </div>
	  </div>
<?php include( ROOT_PATH . '/basdesite.php'); ?>
	  <?php } ?>