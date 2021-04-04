<div class="menu-bar" style='background-color:black;color:#7FFF00;border:0.1em solid #9370DB;text-align:center;'>
        <div style='display:inline-flex;'>
        	<div style="margin:0.5em 17em 0.1em 3em;"><img src="img/esefa.png" alt="ESEFAgadir" style="width:22em;height:5em;" ></div>
        	<div style="margin:0.5em 3em 0.1em 17em;"><img src="img/mcollege.png" alt="Collège belfaa" style="width:22em;height:5em;"></div>
        </div>
		<h1>Gestion des livres et des services de bibliothèque de Collège belfaa</h1>
<div style="display:inline-flex;background-color:rgba(173,255,47,0.4);border-radius:20px;">
       <?php
       

       if(isset($_SESSION['pseudo']))
       {
       

       
          

          echo "<div style='padding:0.3em 1em 0.3em 1em;border-right:0.1em solid #fff;border-radius:0px 20px 20px 0px;'><a href='InfoUser.php' style='font-family:serif;font-size:20px;font-weight:bold;width:auto;text-align:center;text-transform:capitalize;color:#FFD700;' >Profil</a></div>


          <div style='padding:0.3em 1em 0.3em 1em;border-right:0.1em solid #fff;border-radius:0px 20px 20px 0px;'><a href='revue_services.php' style='font-family:serif;font-size:20px;font-weight:bold;width:auto;text-align:center;text-transform:capitalize;color:#FFD700;' >revue services</a></div>


          <div style='padding:0.3em 1em 0.3em 1em;border-right:0.1em solid #fff;border-radius:0px 20px 20px 0px;'><a href='livraison_livres.php?type=accueil' style='font-family:serif;font-size:20px;font-weight:bold;width:auto;text-align:center;text-transform:capitalize;color:#FFD700;' >Livraision des livres</a></div>


          <div style='padding:0.3em 1em 0.3em 1em;border-right:0.1em solid #fff;border-radius:0px 20px 20px 0px;'><a href='AjouterLivre.php?type=accueil' style='font-family:serif;font-size:20px;font-weight:bold;width:auto;text-align:center;text-transform:capitalize;color:#FFD700;' >Ajouter Livre</a></div>

          <div style='padding:0.3em 1em 0.3em 1em;border-right:0.1em solid #fff;border-radius:0px 20px 20px 0px;'><a href='Deconnexion.php' style='font-family:serif;font-size:20px;font-weight:bold;width:auto;text-align:center;text-transform:capitalize;color:#FFD700;' >Déconnexion</a></div>";
          
       }else{

          echo "<div style='padding:0.3em 1em 0.3em 1em;border-right:0.1em solid #fff;border-radius:0px 20px 20px 0px;'><a href='Connexion.php' style='font-family:serif;font-size:20px;font-weight:bold;width:auto;text-align:center;text-transform:capitalize;color:#FFD700;' >connxion</a></div>
          <div style='padding:0.3em 1em 0.3em 1em;border-right:0.1em solid #fff;border-radius:0px 20px 20px 0px;'><a href='Inscription.php' style='font-family:serif;font-size:20px;font-weight:bold;width:auto;text-align:center;text-transform:capitalize;color:#FFD700;' >Inscription</a></div>";

       }
       ?>
</div>
</div>