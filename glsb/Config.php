<?php  //data gryt
	session_start();
	// connect to database
	$con = mysqli_connect('localhost', 'root','');
	if (!$con) {
		die("Error connecting to database: " . mysqli_connect_error());
	}
    // define global constants
	define ('ROOT_PATH', realpath(dirname(__FILE__)));
	define('BASE_URL', 'http://localhost/glsb/');
  include("function.php");
	//*********************************************************************
	   $sql1="SELECT * FROM glsb .langue";
       $list_langue= array();
       $list_langue= mysqli_query($con, $sql1);
       echo "<datalist id='list_langue'  >";
          while($row=mysqli_fetch_assoc($list_langue)){
             echo "<option value=".$row['langue']." ></option>";
          }
       echo "</datalist>";

	   $sql1="SELECT * FROM glsb .niveaus";
       $list_niveau= array();
       $list_niveau= mysqli_query($con, $sql1);
       echo "<datalist id='list_niveau'  >";
          while($row=mysqli_fetch_assoc($list_niveau)){
             echo "<option value=".$row['niveau']." ></option>";
          }
       echo "</datalist>";   

	   $sql1="SELECT * FROM glsb .type_domaine";
       $list_domaine= array();
       $list_domaine= mysqli_query($con, $sql1);
       echo "<datalist id='list_domaine'  >";
          while($row=mysqli_fetch_assoc($list_domaine)){
             echo "<option value=".$row['domaine']." ></option>";
          }
       echo "</datalist>";


     $sql1="SELECT * FROM glsb .etui_livre";
       $list_etui_livre= array();
       $list_etui_livre= mysqli_query($con, $sql1);
       echo "<datalist id='list_etui'  >";
          while($row=mysqli_fetch_assoc($list_etui_livre)){
             echo "<option value=".$row['etui_livre']." ></option>";
          }
       echo "</datalist>";

     $sql1="SELECT * FROM glsb .faisable";
       $list_faisable= array();
       $list_faisable= mysqli_query($con, $sql1);
       echo "<datalist id='list_faisable'  >";
          while($row=mysqli_fetch_assoc($list_faisable)){
             echo "<option value=".$row['faisable']." ></option>";
          }
       echo "</datalist>";

       
    echo "<datalist id='list_metier' size='5' ><option value='Professeur' ></option><option value='Directeur' ></option><option value='frugal' ></option><option value='Administratif' ></option></datalist>";
