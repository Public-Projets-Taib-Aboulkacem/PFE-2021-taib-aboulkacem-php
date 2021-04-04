<?php  include('Config.php'); ?>
<?php require('init.php');?>
<?php  include('hautpage.php'); ?>
	<title>Livraison des livres</title>
</head>
<body>
<?php
/*dons le page connecxion et inscription*/
	if(!isset($_SESSION['pseudo'])) {
		header("location: connexion.php");
	}else{
?>
   <?php include( ROOT_PATH . '/menu.php'); ?>
   <div id='mil-u'>

<?php 
if(isset($_GET['type']) && $_GET['type'] == "accueil" ){
   echo  "rechercher l'élève : <input type='text' id='recherch_eleve' >";
             scritp_cherche("eleves","recherch_eleve");
             afficher_eleves($con,"eleves");
}
?>
<?php 
if(isset($_GET['type']) && $_GET['type'] == "livre" && isset($_GET['cne']) ){
   echo  "rechercher livre : <input type='text' id='recherch_livre' >";  
             scritp_cherche("livres","recherch_livre");
             afficher_livres($con,"livres",$_GET['cne']); 
}
?>
<?php 
if(isset($_GET['type']) && $_GET['type'] == "commande" && isset($_GET['cne']) && isset($_GET['codelivre'])){
   $cne=$_GET['cne'];
   $codelivre=$_GET['codelivre'];
   $errors = array();
   $sql1="SELECT * FROM glsb . eleve WHERE cne='$cne'";
   $sql2="SELECT * FROM glsb . livre WHERE codelivre='$codelivre' ";
    $rqt1=mysqli_query($con,$sql1);
    $eleve=mysqli_fetch_assoc($rqt1);
    $rqt2=mysqli_query($con,$sql2);
    $livre=mysqli_fetch_assoc($rqt2);
  if(isset($_POST['validelivraison'])){
    $date_recuperation=$_POST['date_recuperation'];
    if (empty($date_recuperation)) {  array_push($errors, "Vous devez entrer Date de récupéré le livre par l'élève"); }else{
      $codelivre=$livre['codelivre'];
      $cne=$eleve['cne'];
      $inserting="INSERT INTO glsb . livraison(codelivre,cne,date_livraison,date_recuperation) VALUES ('$codelivre','$cne',now(),'$date_recuperation')";
      $seting="UPDATE glsb . livre SET faisable=a_été_livré WHERE codelivre=$codelivre ";
      $insert=mysqli_query($con,$inserting);
    }

  }
echo "<form method='post' action='livraison_livres.php?type=commande&cne=$cne&codelivre=$codelivre' id='aj_livre' ><div style='display:inline-flex;' >" ;
    include(ROOT_PATH . '/errors.php');
    ?>
    <table border="0" id='aj_livre'>
      <tr colspan="2" ><th>L'élève</th></tr>
      <tr><td>N°:</td><td><?php echo $eleve['num']; ?></td></tr>
      <tr><td>CNE:</td><td><?php echo $eleve['cne']; ?></td></tr>
      <tr><td>nom:</td><td><?php echo $eleve['nom']; ?></td></tr>
      <tr><td>prénom:</td><td><?php echo $eleve['prenom']; ?></td></tr>
      <tr><td>sex:</td><td><?php echo $eleve['sex']; ?></td></tr>
      <tr><td>niveau:</td><td><?php echo $eleve['niveau']; ?></td></tr>
      <tr><td>annees:</td><td><?php echo $eleve['annees']; ?><br/></td></tr>
    </table>
    <table border="0" id='aj_livre'>
      <tr><th>Livre</th></tr>
      <tr><td>code livre:</td><td><?php echo $livre['codelivre']; ?></td></tr>
      <tr><td>titre:</td><td><?php echo $livre['titre']; ?></td></tr>
      <tr><td>date publication:</td><td><?php echo $livre['date_publication']; ?></td></tr>
      <tr><td>lange:</td><td><?php echo $livre['langue']; ?></td></tr>
      <tr><td>auteur:</td><td><?php echo $livre['auteur']; ?></td></tr>
      <tr><td>prix:</td><td><?php echo $livre['prix']; ?>Dh</td></tr>
      <tr><td>domaine:</td><td><?php echo $livre['domaine']; ?></td></tr>
      <tr><td>faisalbe:</td><td><?php echo $livre['faisable']; ?><br/></td></tr>
    </table>
    <table border="0" id='aj_livre'>
      <tr><th>Important</th></tr>
      <tr><td>Date de récupéré le livre par l'élève <?php echo $eleve['nom']; ?>:</td><td><input type="date" name="date_recuperation"></td></tr>
    </table>
    <?php
echo "</div><br><button name='validelivraison' >Validé La Commande</button></form>";
}
?>
<?php 
if(isset($_GET['type']) && $_GET['type'] == "accueil" ){

}
?>
<?php 
if(isset($_GET['type']) && $_GET['type'] == "accueil" ){

}
?>



	</div>
    <?php include( ROOT_PATH . '/basdesite.php'); ?>
<?php } ?>




















































<?php /*
if(isset($_GET['type']) && $_GET['type'] == "eleve" ){ ?>
<div style="display:inline-flex;">
  <div>
    Recherch élève : <input type="text" id="recherch_eleve" >
    <?php
             scritp_cherche("eleves","recherch_eleve");
             afficher_eleves($con,"eleves");
         ?>
  </div>
</div>
    <?php

}
if(isset($_GET['type']) && $_GET['type'] == "livre" ){
  if( isset($_GET['nom']) && isset($_GET['prenom']) && isset($_GET['CNE']) ){
   $nom=$_GET['nom'];$prenom=$_GET['prenom'];$cne=$_GET['CNE'];$num=$_GET['num'];$sex=$_GET['sex'];$niveau=$_GET['niveau'];
       echo "<table id='table1'><tr><th>carate d'élève</th></tr><tr><td>$num</td></tr><tr><td>$cne</td></tr><tr><td>$nom</td></tr><tr><td>$prenom</td></tr><tr><td>$sex</td></tr><tr><td>$niveau</td></tr></table>";
?>
    <div>
    Recherch Livre : <input type="text" id="recherch_livre" >
    <?php
             scritp_cherche("livres","recherch_livre");
             afficher_livres($con,"livres");
         ?>   
  </div>
<?php  } ?>
<?php } 
if(isset($_GET['type']) && $_GET['type'] == "livraison" ){
  if( isset($_GET['nom']) && isset($_GET['prenom']) && isset($_GET['CNE']) ){
   $nom=$_GET['nom'];$prenom=$_GET['prenom'];$cne=$_GET['CNE'];$num=$_GET['num'];$sex=$_GET['sex'];$niveau=$_GET['niveau'];
       echo "<table id='table1'><tr><th>carte d'élève</th></tr><tr><td>Num: $num</td></tr><tr><td>CNE: $cne</td></tr><tr><td>$nom</td></tr><tr><td>$prenom</td></tr><tr><td>sex: $sex</td></tr><tr><td>$niveau</td></tr></table>";
?>
    <div>
    Recherch Livre : <input type="text" id="recherch_livre" >
    <?php
             scritp_cherche("livres","recherch_livre");
             afficher_livres($con,"livres",$nom,$prenom,$cne,$num,$sex,$niveau);
         ?>   
  </div>
<?php  } ?>
<?php } ?>



<?php 
if(isset($_GET['type']) && $_GET['type'] == "validelivraison" ){
  if( isset($_GET['nom']) && isset($_GET['prenom']) && isset($_GET['CNE']) && isset($_GET['codelivre']) && isset($_GET['titre']) && isset($_GET['auteur']) && isset($_GET['prix']) && isset($_GET['langue']) && isset($_GET['sex']) && isset($_GET['date_publication']) ){
   $nom=$_GET['nom'];$prenom=$_GET['prenom'];$cne=$_GET['CNE'];$num=$_GET['num'];$sex=$_GET['sex'];$niveau=$_GET['niveau'];
   $codelivre=$_GET['codelivre'];$langue=$_GET['langue'];$auteur=$_GET['auteur'];$date_publication=$_GET['date_publication'];$prix=$_GET['prix'];$domaine=$_GET['domaine'];$faisable=$_GET['faisable'];$date_insertion=$_GET['date_insertion'];$titre=$_GET['titre'];
       echo "<table id='table1'><tr><th>carte d'élève</th></tr><tr><td>Num: $num</td></tr><tr><td>CNE: $cne</td></tr><tr><td>$nom</td></tr><tr><td>$prenom</td></tr><tr><td>sex: $sex</td></tr><tr><td>$niveau</td></tr></table>";
?>
    <div>
    Recherch Livre : <input type="text" id="recherch_livre" >
    <?php
             scritp_cherche("livres","recherch_livre");
             afficher_livres($con,"livres",$nom,$prenom,$cne,$num,$sex,$niveau);
         ?>   
  </div>
<?php  } ?>
<?php } */?>