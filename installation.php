<style type='text/css'>
	.div1{text-align:center;margin:auto;}
	.tout{width:50%;min-height:50%;background-color:#ADFF2F;margin:auto;margin-top:10em;border: 3px solid green;}
	.por1{width:100%;height:1em;background-color:lime;border-radius:20px 20px 20px 20px;}
	.por2{height:1em;background-color:red;border-radius:20px 20px 20px 20px;}
  #entete, #menu, #contenu, #footer {padding:1px 0;}
  #entete {background-color:#FF9900;text-align:center;}
  #main {max-with:960px;margin:auto;}
  #menu  {float:left;width:240px;background-color:#FF3366;}
  #contenu {margin-left:245px;background-color:#9966FF;}
  #footer {background-color:#669933;text-align:center;clear:both;}
</style>
<?php session_start();
$con = mysqli_connect('localhost', 'root','');
  if ((!mysqli_select_db($con,"glsb") && isset($_GET['sui']) && $_GET['sui']< 1) && isset($_GET['sui'])){
     header("location: installation.php");
  }
function execut($rqt){
   $con = mysqli_connect('localhost', 'root','');
   return mysqli_query($con,$rqt);
}
if (!$con) {
		die('Error connecting to database: ' . mysqli_connect_error());
}else{
	$i=0;if(isset($_GET['sui'])){$i=$_GET['sui'];if($i>=100) $i=0;}
	if(isset($_POST['logo_nom'])){
		$logo_etabl=$_FILES['logo_etabl'];
		if( empty($logo_etabl) || ( exif_imagetype($logo_etabl['tmp_name']) != IMAGETYPE_PNG && exif_imagetype($logo_etabl['tmp_name']) != IMAGETYPE_JPEG ) ){header("location: installation.php?sui=2");}else{
			copy($logo_etabl['tmp_name'] , "img/".$logo_etabl['name']);
          if( file_exists("img/logo_etabl.png") ){
            unlink("img/logo_etabl.png");
            rename("img/".$logo_etabl['name'], "img/logo_etabl.png" );
          }else{
            rename("img/".$logo_etabl['name'], "img/logo_etabl.png" );
          }
          execut("INSERT INTO glsb . annee_scolaire(id,annee_d,annee_f,annees) VALUES (1,now(),now(),'2020/2021')");
          header("location: installation.php?sui=3");
		}
	}
  if(isset($_POST['forma_site'])){
          $tete=$_POST['tête'];
          $menu=$_POST['menu'];
          $contenu=$_POST['Contenu'];
          $text=$_POST['text'];
          $Pied=$_POST['Pied'];
          $nom_ecole=$_POST['nom_etabl'];
          if( empty($tete) || empty($menu) || empty($contenu) || empty($text) || empty($Pied) || empty($nom_ecole) ){
             header("location: installation.php?sui=3");
          }else{
            execut("INSERT INTO glsb . forma_site(col_tete,col_menu,col_contenu,col_text,col_Pied,nom_ecole) VALUES('$tete','$menu','$contenu','$text','$Pied','$nom_ecole')");
            header("location: installation.php?sui=4");
          }

}
if(isset($_POST['sup'])){execut("DROP database glsb");}
if(isset($_POST['Envoyer_key'])){$key_de_produit=$_POST['key_de_produit'];if(empty($key_de_produit)){header("location: installation.php?sui=1");}else{unlink("index.php");header("location: code8.php?key=$key_de_produit");}}
?>
<form action='Installation.php' method='post' enctype="multipart/form-data" >
	
<button name="sup" >sup</button>
<div class='div1'>
	<div class='tout'>
        <audio controls autoplay><source src="mp.ogg" type="audio/ogg"><source src="mp.mp3" type="audio/mpeg"></audio>
		<h1>Installation de site </h1>
		<div class="por1"><div class="por2" style="width:<?php if($i<=100) echo ($i*2)."%;";?>" ></div></div>
<?php 
   switch ($i) {
   	case 0:{
?>
<h2>Étape 1:</h2>
<h2>Conditions d'utilisation</h2>
<div>
	Le développeur est en train de progresser et d'apprendre. Cette copie est considérée comme un projet d'apprentissage à la fin des études à l'université. Sa diffusion est autorisée. Il respecte la vie privée des utilisateurs.
</div>
<button><a <?php echo "href='installation.php?sui=".($i+1)."'";?> >Acceptation</a></button>
<?php 
    }break;
   	case 1:{
?>
<h2>Étape 2:</h2>
<h2>En cours d'installation</h2>
Entrez le code produit. Demandez au programmeur de vous l'envoyer pour installer et utiliser le site :<input type="text" name="key_de_produit" ><input type="submit" name="Envoyer_key">
<?php 
    }break;
    case 2:{
?>
<h2>Étape 2:</h2>
<h2>Informations spécifiques à l'établissement</h2>
  <label for="logo_etabl">image logo de l'établissement:</label><input type="file" name="logo_etabl" id="logo_etabl" ><br><br>
  <input type="submit" value="Suivant" name="logo_nom" >
<?php
    }break;
    case 3:{
?>
<div id="entete">
 En tête <br>color fond:<input type="color" name="tête" value="#FF9900"><br>
</div>

<div id="main">
 <div id="menu">
  Menu <br>color fond:<input type="color" name="menu" value="#FF3366"><br>
 </div>

 <div id="contenu">
  Contenu <br>color fond:<input type="color" name="Contenu" value="#9966FF" ><br>
  Color de text :<input type="color" name="text" value="#7FFF00" ><br>
<label for="nom_etabl">Nom de l'établissement:</label><input type="text" name="nom_etabl" id="nom_etabl" value="Collège Belfaa"><br><br>
 </div>
</div>

<div id="footer">
 Pied de Page <br>color fond:<input type="color" name="Pied" value="#669933" ><br>
</div>
<input type="submit" value="Suivant" name="forma_site" >
<?php
    }break;
    case 4:{
        unlink("mp.mp3");
        unlink("code8.php");
        unlink("installation.php");
      header("location: connexion.php");
    }break;   	
   	default:
   		echo 'error';
   		break;
   }
?>
	</div>
</div>
</form>
<?php 
}
?>