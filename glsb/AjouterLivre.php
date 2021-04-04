<?php  include('Config.php'); ?>
<?php  include('hautpage.php'); ?>
	<title>Ajouter des livres</title>
</head>
<body>
<?php
  if(!isset($_SESSION['pseudo'])) {
    header("location: connexion.php");
  }else{
?>
   <?php include('menu.php'); ?>
   <div id='mil-u'>
<?php $num=0;
if(isset($_GET['type']) && $_GET['type'] == "accueil" ){
  if(isset($_POST['valid1'])){$num=$_POST['numlivre'];if(empty($num) || $num == 0 ){}else{
   echo "<a href='AjouterLivre.php?type=seul&num=".$num."' >Ajeuté un seul livre :ICI</a><br>";
   echo "<a href='AjouterLivre.php?type=pluscopier&num=".$num."' >Ajeuté les copeirs des livre :ICI</a><br>";
   echo "<a href='AjouterLivre.php?type=dossier_livre&num=".$num."' >Ajeuté un dossier livre :ICI</a><br>";
   echo "<a href='AjouterLivre.php?type=nouvelle_edition&num=1' >Ajeuté un nouvelle edition livre :ICI</a><br>";    
  }}
   if($num == 0 ){echo "nomber des linvres ajouter :<form method='post' action='AjouterLivre.php?type=accueil' ><input type='number' name='numlivre' value='1' /><button name='valid1' >Go</button><br></from>";}
}
?>
<?php 
if(isset($_GET['type']) && $_GET['type'] == "seul" && isset($_GET['num']) ){
    $codelivre="";
    $titre="";
    $date_publication="";
    $langue="";
    $auteur="";
    $prix=0;
    $domaine="";
    $faisable="";
    $errors = array();
if(isset($_POST['seulinsert'])){
  for($i=1;$i<=$_GET['num'];$i++){
    $codelivre=$_POST["codelivre$i"];
    $titre=$_POST["titre$i"];
    $date_publication=$_POST["date_publication$i"];
    $langue=$_POST["langue$i"];
    $auteur=$_POST["auteur$i"];
    $prix=$_POST["prix$i"];
    $domaine=$_POST["domaine$i"];
    $faisable=$_POST["faisable$i"];
    if (empty($codelivre)) {  array_push($errors, "Vous devez entrer votre code livre"); }
    if (empty($titre)) {  array_push($errors, "Vous devez entrer votre titre"); }
    if (empty($date_publication)) {  array_push($errors, "Vous devez entrer votre date publication"); }
    if (empty($langue)) {  array_push($errors, "Vous devez entrer votre langue"); }
    if (empty($auteur)) {  array_push($errors, "Vous devez entrer votre auteur"); }
    if (empty($prix)) {  array_push($errors, "Vous devez entrer votre prix"); }
    if (empty($domaine)) {  array_push($errors, "Vous devez entrer votre domaine"); }
    if (empty($faisable)) {  array_push($errors, "Vous devez entrer votre faisable");}
    $sql="SELECT * FROM glsb . livre WHERE codelivre='$codelivre' AND titre='$titre' AND langue='$langue' OR codelivre='$codelivre' ";
    $rqt=mysqli_query($con,$sql);
     $livre=mysqli_fetch_assoc($rqt);
     if($livre){
        if( $livre['codelivre'] == $codelivre ){
              array_push($errors, "Ce code existe déjà ");
        }if($livre['codelivre'] && $livre['titre'] == $titre && $livre['langue'] == $langue ){
              array_push($errors, "Ce livre existe déjà");
        }
     }
    if(count($errors) == 0 ){
      $sql="INSERT INTO glsb . livre VALUES ('$codelivre','$titre','$date_publication','$langue','$auteur',$prix,'$domaine','$faisable',now())";
      $rqt=mysqli_query($con,$sql);
    }  
  }
}
     include(ROOT_PATH . '/errors.php');
     format_aj_livre($_GET['num'],"seul","seulinsert");
}
?>
<?php 
if(isset($_GET['type']) && $_GET['type'] == "pluscopier" && isset($_GET['num'])){
    $codelivre="";
    $titre="";
    $date_publication="";
    $langue="";
    $auteur="";
    $prix=0;
    $domaine="";
    $faisable="";
    $errors = array();
if(isset($_POST['pluscopierinsert'])){
    $titre=$_POST["titre"];
    $date_publication=$_POST["date_publication"];
    $langue=$_POST["langue"];
    $auteur=$_POST["auteur"];
    $prix=$_POST["prix"];
    $domaine=$_POST["domaine"];
    if (empty($titre)) {  array_push($errors, "Vous devez entrer votre titre"); }
    if (empty($date_publication)) {  array_push($errors, "Vous devez entrer votre date publication"); }
    if (empty($langue)) {  array_push($errors, "Vous devez entrer votre langue"); }
    if (empty($auteur)) {  array_push($errors, "Vous devez entrer votre auteur"); }
    if (empty($prix)) {  array_push($errors, "Vous devez entrer votre prix"); }
    if (empty($domaine)) {  array_push($errors, "Vous devez entrer votre domaine"); }
  for($i=1;$i<=$_GET['num'];$i++){
    $codelivre=$_POST["codelivre$i"];
    $faisable=$_POST["faisable$i"];
    if (empty($codelivre)) {  array_push($errors, "Vous devez entrer votre code livre"); }
    if (empty($faisable)) {  array_push($errors, "Vous devez entrer votre faisable");}
    $sql="SELECT * FROM glsb . livre WHERE codelivre='$codelivre' AND titre='$titre' AND langue='$langue' OR codelivre='$codelivre' ";
    $rqt=mysqli_query($con,$sql);
     $livre=mysqli_fetch_assoc($rqt);
     if($livre){
        if( $livre['codelivre'] == $codelivre ){
              array_push($errors, "Ce code existe déjà ");
        }if($livre['codelivre'] && $livre['titre'] == $titre && $livre['langue'] == $langue ){
              array_push($errors, "Ce livre existe déjà");
        }
     }
    if(count($errors) == 0 ){
      $sql="INSERT INTO glsb . livre VALUES ('$codelivre','$titre','$date_publication','$langue','$auteur',$prix,'$domaine','$faisable',now())";
      $rqt=mysqli_query($con,$sql);
    }  
  }
}
    include(ROOT_PATH . '/errors.php');
    format_aj_livre($_GET['num'],"pluscopier","pluscopierinsert");
}
?>
<?php 
if(isset($_GET['type']) && $_GET['type'] == "dossier_livre" && isset($_GET['num']) ){
    $codelivre="";
    $titre="";
    $date_publication="";
    $langue="";
    $auteur="";
    $prix=0;
    $domaine="";
    $faisable="";
    $errors = array();
if(isset($_POST['dossier_livreinsert'])){
    $langue=$_POST["langue"];
    $auteur=$_POST["auteur"];
    if (empty($langue)) {  array_push($errors, "Vous devez entrer votre langue"); }
    if (empty($auteur)) {  array_push($errors, "Vous devez entrer votre auteur"); }
  for($i=1;$i<=$_GET['num'];$i++){
    $titre=$_POST["titre$i"];
    $date_publication=$_POST["date_publication$i"];
    $codelivre=$_POST["codelivre$i"];
    $faisable=$_POST["faisable$i"];
    $prix=$_POST["prix$i"];
    $domaine=$_POST["domaine$i"];
    if (empty($titre)) {  array_push($errors, "Vous devez entrer votre titre"); }
    if (empty($date_publication)) {  array_push($errors, "Vous devez entrer votre date publication"); }
    if (empty($prix)) {  array_push($errors, "Vous devez entrer votre prix"); }
    if (empty($domaine)) {  array_push($errors, "Vous devez entrer votre domaine"); }
    if (empty($codelivre)) {  array_push($errors, "Vous devez entrer votre code livre"); }
    if (empty($faisable)) {  array_push($errors, "Vous devez entrer votre faisable");}
    $sql="SELECT * FROM glsb . livre WHERE codelivre='$codelivre' AND titre='$titre' AND langue='$langue' OR codelivre='$codelivre' ";
    $rqt=mysqli_query($con,$sql);
     $livre=mysqli_fetch_assoc($rqt);
     if($livre){
        if( $livre['codelivre'] == $codelivre ){
              array_push($errors, "Ce code existe déjà ");
        }if($livre['codelivre'] && $livre['titre'] == $titre && $livre['langue'] == $langue ){
              array_push($errors, "Ce livre existe déjà");
        }
     }
    if(count($errors) == 0 ){
      $sql="INSERT INTO glsb . livre VALUES ('$codelivre','$titre','$date_publication','$langue','$auteur',$prix,'$domaine','$faisable',now())";
      $rqt=mysqli_query($con,$sql);
    }  
  }
}
    include(ROOT_PATH . '/errors.php');
    format_aj_livre($_GET['num'],"dossier_livre","dossier_livreinsert");
}
?>
<?php 
if(isset($_GET['type']) && $_GET['type'] == "nouvelle_edition" && isset($_GET['num']) ){
    $codelivreencien="";
    $codelivre="";
    $titre="";
    $date_publication="";
    $prix=0;
    $faisable="";
    $errors = array();
if(isset($_POST['nouvelle_editioninsert'])){
    $codelivreencien=$_POST["codelivreencien"];
    $codelivre=$_POST["codelivre"];
    $titre=$_POST["titre"];
    $date_publication=$_POST["date_publication"];
    $faisable=$_POST["faisable"];
    $prix=$_POST["prix"];
    if (empty($codelivreencien)) {  array_push($errors, "Vous devez entrer votre code livre encien"); }
    if (empty($codelivre)) {  array_push($errors, "Vous devez entrer votre code livre"); }
    if (empty($titre)) {  array_push($errors, "Vous devez entrer votre titre"); }
    if (empty($date_publication)) {  array_push($errors, "Vous devez entrer votre date publication"); }
    if (empty($prix)) {  array_push($errors, "Vous devez entrer votre prix"); }
    if (empty($faisable)) {  array_push($errors, "Vous devez entrer votre faisable");}
    $sql="SELECT * FROM glsb . livre WHERE codelivre='$codelivre' AND titre='$titre'  OR codelivre='$codelivre' ";
    $rqt=mysqli_query($con,$sql);
     $livre=mysqli_fetch_assoc($rqt);
     if($livre){
        if( $livre['codelivre'] == $codelivre ){
              array_push($errors, "Ce code existe déjà ");
        }if($livre['codelivre'] && $livre['titre'] == $titre && $livre['langue'] == $langue ){
              array_push($errors, "Ce livre existe déjà");
        }
     }
    if(count($errors) == 0 ){

    $sql="SELECT * FROM glsb . livre WHERE codelivre='$codelivreencien' ";
    $rqt=mysqli_query($con,$sql);
     $livre=mysqli_fetch_assoc($rqt);
     if($livre){
        if( $livre['codelivre'] == $codelivreencien ){
           $langue=$livre['langue'];
           $auteur=$livre['auteur'];
           $domaine=$livre['domaine'];
        $sql="INSERT INTO glsb . livre VALUES ('$codelivre','$titre','$date_publication','$langue','$auteur',$prix,'$domaine','$faisable',now())";
        $rqt=mysqli_query($con,$sql);                    
        }else{
           array_push($errors, "Ce code n'existe pas Ou livre encien n'existe pas");
        }
     }
    }  
}   
   include(ROOT_PATH . '/errors.php');
   format_aj_livre($_GET['num'],"nouvelle_edition","nouvelle_editioninsert");
}
?>
   </div>
<?php include( ROOT_PATH . '/basdesite.php'); ?>
<?php } ?>