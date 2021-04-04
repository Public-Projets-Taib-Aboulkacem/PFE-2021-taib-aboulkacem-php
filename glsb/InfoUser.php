<?php  include('Config.php'); ?>
<?php  include('hautpage.php'); ?>
	<title>Profaile :</title>
</head>
<body>
<?php
    
	if(!isset($_SESSION['pseudo'])) 
	{
		header("location: connexion.php");
		exit;
    }else {
?>
	 <?php include( ROOT_PATH . '/menu.php'); ?>
<div style='background-color:#060c21;color:#7FFF00;padding:1em 2em 1em 2em;font-size:30px;text-align:center;' >
	
<?php
$pseudo=$_SESSION['pseudo'];
$sel="select * from glsb . users ";
$moi="select * from glsb . users WHERE pseudo='$pseudo'";
$rqt2=mysqli_query($con,$sel) or die("errore query");
$rqt1=mysqli_query($con,$moi) or die("errore query");
?>
<form method="post" action="InfoUser.php" >
	 <h3>Me Information</h3>
<div style="display:inline-flex;">
	<div style="background-color:rgba(173,255,47,0.4);border-radius:20px;border:0.1em solid #FFD700;padding:0.5em;">
  <?php
     while ($row = mysqli_fetch_assoc($rqt1)){ ?>
      <table border="0">
          <tr><th>id :<?php echo $row['id'];$id=$row['id'];?></th></tr>
	      <tr><td>Nom :<?php echo $row['pseudo'];$nomaff=$row['pseudo'];?></td></tr>
	      <tr><td>Email :<?php echo $row['email'];$emailaff=$row['email'];?></td></tr>
	      <tr><td>Date Inscription :<?php echo $row['date_inscription'];?></td></tr>
		 </table>
 <?php }?>		
	</div>
	<div style="background-color:rgba(173,255,47,0.4);border-radius:20px;border:0.1em solid #FFD700;padding:0.5em;">
     <?php include('ModifierUser.php'); ?>
     <form method="post" action="ModifierUser.php">
       <table border="0">
          <tr><th><?php include(ROOT_PATH . '/errors.php') ?>Modifier les Donnees ici</th></tr>
	      <tr><td>Nom :</td><td><input type="text" name="pseudo" value="<?php echo $nomaff;?>" ></td></tr>
	      <tr><td>Email :</td><td><input type="text" name="email" value="<?php echo $emailaff;?>" ></td></tr>
	      <tr><td>mot de passe avont :</td><td> <input type="password" name="PassPass" ></td></tr>
	      <tr><td>Noveux mot de passe : </td><td><input type="password" name="password_1" ></td></tr>
	      <tr><td>Retapez votre Noveux mot de passe : </td><td><input type="password" name="password_2" ></td></tr>
	      <tr><td><button name="btn_mod_user">Modifier</button></td></tr>
		 </table>
	 </form>		
	</div>
</div>


	 <h3>tous les utilisateurs</h3>
  <?php
     while ($row = mysqli_fetch_assoc($rqt2)){ ?>
      <table border="0" style="background-color:rgba(173,255,47,0.4);border-radius:20px;border:0.1em solid #FFD700;padding:1em;">
          <tr><th>id :<?php echo $row['id']; ?></th></tr>
	      <tr><td>Nom :<?php echo $row['pseudo'];?></td></tr>
	      <tr><td>Email :<?php echo $row['email'];?></td></tr>
	      <tr><td>Date Inscription :<?php echo $row['date_inscription'];?></td></tr>
		 </table>
 <?php }?>
</div>
    <?php include( ROOT_PATH . '/basdesite.php'); ?>
<?php } ?>