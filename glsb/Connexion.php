<?php  include('Config.php'); ?>
<?php require('init.php');?>
<?php  include('hautpage.php'); ?>
	<title>Page de Connexion</title>
</head>
<body>
<?php
/*dons le page connecxion et inscription*/
	if(isset($_SESSION['pseudo'])) 
	{
		header("location: Index.php");
		exit;
	}else {
?>
<div>
   <?php include( ROOT_PATH . '/menu.php'); ?>
   <div style='background-color:#060c21;color:#7FFF00;padding:1em 2em 1em 2em;font-size:30px;text-align:center;' >
   	   <?php
	    $pseudo = "";
	    $pass= "";
	    $errors = array();
	   if(isset($_POST['Conn_btn'])){
		   $pseudo=$_POST['pseudo'];
		   $pass=$_POST['password'];
		if (empty($pseudo)) { array_push($errors, "Vous devez entrer votre Pseudo"); }
		if (empty($pass)) { array_push($errors, "Vous devez entrer votre Password"); }
		if (empty($errors)) {
			
		   $sql1="SELECT * FROM glsb.users WHERE pseudo='$pseudo'";
		   $result=mysqli_query($con,$sql1);
		   if( mysqli_num_rows($result) > 0){
		   $tab=mysqli_fetch_array($result);
		     if(password_verify($pass,$tab['pass'])){
		       $_SESSION['pseudo']=$_POST['pseudo'];
               $_SESSION['email']=$tab['email'];
               $_SESSION['id']=$tab['id'];
			      if(isset($_POST['remember_me']) && $_POST['remember_me'] == 'on'){
                       setcookie('pseudo',$pseudo,time()*3600*24*365,null,null, false,true);
                  }
                   header("location: Index.php");	   
		   }else {
				array_push($errors, 'Les informations sont incorrectes');
			}
		   }else{
			   array_push($errors, 'Les informations sont incorrectes');
		   }
	     }
	   }
	   ?>
	   <?php include( ROOT_PATH . '/FormaConn.php') ?>
</div></div>
<?php include( ROOT_PATH . '/basdesite.php'); ?>
	  <?php } ?>