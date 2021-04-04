<?php
	if(!isset($_SESSION['pseudo'])) 
	{
		header("location: Connexion.php");
		exit;
    }else {
?>
<?php 

	$pseudo = "";
	$pseudoF = $_SESSION['pseudo'];
	$email    = "";
	$PassPass    = "";
	$password_1= "";
	$password_2= "";
	$errors = array(); 

    if(isset($_POST['btn_mod_user'])){
			$pseudo =$_POST['pseudo'];
		    $email = $_POST['email'];
		    $password_1 = $_POST['password_1'];
		    $PassPass = $_POST['PassPass'];
		    $password_2 =$_POST['password_2'];
			if (empty($pseudo)) {  array_push($errors, "Vous devez entrer votre Pseudo"); }
		    if (empty($email)) { array_push($errors, "Vous devez entrer votre email"); }
		    if (empty($password_1)) { array_push($errors, "Vous devez entrer votre  password"); }
		    if (empty($password_2)) { array_push($errors, "Vous devez retapper votre password"); }
		    if (empty($PassPass)) { array_push($errors, "Vous devez entrer votre avent password"); }else{
					   
		   $sqlF="SELECT * FROM glsb.users WHERE pseudo='$pseudoF'";
		   $resultF=mysqli_query($con,$sqlF);
		   $tabF=mysqli_fetch_array($resultF);
		     if(password_verify($PassPass,$tabF['pass'])){
		    if ($password_1 != $password_2) { array_push($errors, "votre password ne pas correcte");}
		    $user_exists = "SELECT * FROM glsb.users WHERE id NOT IN ($id) AND (pseudo='$pseudo' OR email='$email') LIMIT 1";
		    $result = mysqli_query($con, $user_exists);
		    $user = mysqli_fetch_assoc($result);
		if ($user) { // if user exists
			   if ($user['pseudo'] === $pseudo) {
			     array_push($errors, "Ce pseudo exists déjà");
		     	}
			   if ($user['email'] === $email) {
			     array_push($errors, "Ce email exists déjà");
			   }
			}		
		if (count($errors) == 0) {
				$password = password_hash($password_1,PASSWORD_BCRYPT);
		        $query = "UPDATE glsb.users SET pseudo='$pseudo',email='$email' ,pass='$password' WHERE id='$id'";
				$req=mysqli_query($con, $query);
				if($req){
			    $_SESSION['pseudo']=$_POST['pseudo'];
                $_SESSION['email']=$_POST['email'];
                $_SESSION['id']=$id;
				header('location: InfoUser.php');
				}else{
					array_push($errors, "Aucune modification n'a été apportée. Il y a un bogue dans le programme");
				}  
		    }
			}else{ array_push($errors, "L'ancien password est incorrect");}}
	    }
	?>
<?php }?>