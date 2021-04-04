<?php  include('Config.php'); ?>
<?php require('init.php');?>
<?php  include('hautpage.php'); ?>
	<title>Revue des services</title>
</head>
<body>
<?php
	if(!isset($_SESSION['pseudo'])) {
		header("location: connexion.php");
	}else{
?>
   <?php include( ROOT_PATH . '/menu.php'); ?>
   <div id='mil-u'>
<?php
if(!isset($_GET['type'])){
echo "<table>
         <tr>
            <td><a href='revue_services.php?type=livre_livers' ></a></td>
            <td><a href='revue_services.php?type=' ></a></td>
            <td><a href='revue_services.php?type=' ></a></td>
            <td><a href='revue_services.php?type=' ></a></td>
         </tr>
      </table>";
}
if(isset($_GET['type']) && $_GET['type'] == "livre_livers" ){
   $sql="SELECT * FROM glsb . livraison WHERE id_livraison NOT IN (SELECT id_livraison FROM glsb . recevoir ) ";
   
}
?>
	</div>
    <?php include( ROOT_PATH . '/basdesite.php'); ?>
<?php } ?>
