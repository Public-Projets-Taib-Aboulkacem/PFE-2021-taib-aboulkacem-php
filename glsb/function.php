<?php
  function scritp_cherche($id_table,$id_post_recherch){ ?> 
    <script type='text/javascript'>$(document).ready(function(){$('#<?php echo $id_post_recherch; ?>').on('keyup',function(){var value=$(this).val().toLowerCase();$('#<?php echo $id_table; ?> tr').filter(function(){$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)});$('#<?php echo $id_table; ?> tr:frist').show();  });});
    </script>  
 <?php }

function afficher_livres($con,$id_table,$cne){
    $rsql="SELECT * FROM glsb . livre ";
    $rrqt=mysqli_query($con,$rsql);
echo '<table>'; 
echo "<thead style='background-color:#7FFF00;text-align:center;font-size:30px;' ><tr><th>code livre</th><th>titre</th><th>date publication</th><th>langue</th><th>auteur</th><th>prix</th><th>domaine</th><th>faisable</th><th>Chois du livre</th></tr></thead>";
echo "<tbody id='$id_table' style='background-color:#FF7F50;text-align:center;font-size:30px;' >";
        while( $rrow = mysqli_fetch_assoc($rrqt) ){
        	$col="";
            $codelivre = $rrow['codelivre'];
            $titre =$rrow['titre'];
            $date_publication =$rrow['date_publication'];
            $langue =$rrow['langue'];
            $auteur =$rrow['auteur'];
            $prix =$rrow['prix'];
            $domaine =$rrow['domaine'];
            $faisable =$rrow['faisable'];
                  if($faisable == "a_été_livré" ){$col="red";}
                  if($faisable == "n'existe_pas" ){$col="green";}
                  if($faisable == "présent" ){$col="#FF7F50";}
            $date_insertion =$rrow['date_insertion'];
            $echo="<tr style=\"background-color:$col;\" ><td>".$codelivre."</td><td>".$titre."</td><td>".$date_publication."</td><td>".$langue."</td><td>".$auteur."</td><td>".$prix."</td><td>".$domaine."</td><td>".$faisable."</td>";
            if( $faisable == "présent" ){
            	$echo.="<td><button><a href='livraison_livres.php?type=commande&cne=$cne&codelivre=$codelivre' >Go</a></button></td></tr>";
            }else{
                 $echo.="<td><button>Vide</button></td></tr>";
            }echo $echo;  
        }


    echo '</tbody></table>';


} ?>

 <?php function afficher_eleves($con,$id_table){
 	$annees =""; $annees .= (date('Y')-1);$annees .= "/".date('Y');
    $sql="SELECT * FROM glsb . eleve WHERE annees='$annees' ";
    $rqt=mysqli_query($con,$sql);

echo '<table>'; 
echo "<thead style='background-color:#7FFF00;text-align:center;font-size:30px;' ><tr><th>N°</th><th>Code Massar</th><th>Prénom</th><th>Nom</th><th>sex</th><th>Niveau</th><th>annee scolaire</th><th>Donner un livre</th></tr></thead>";
echo "<tbody id='$id_table' style='background-color:#FF7F50;text-align:center;font-size:30px;' >";
        while($row=mysqli_fetch_assoc($rqt)){
            $annees = $row['annees'];
            $num =$row['num'];
            $cne =$row['cne'];
            $prenom =$row['prenom'];
            $sex =$row['sex'];
            $nom =$row['nom'];
            $niveau =$row['niveau'];
                    echo "<tr><td>".$num."</td><td>".$cne."</td><td>".$prenom."</td><td>".$nom."</td><td>".$sex."</td><td>".$niveau."</td><td>".$annees."</td><td><button><a href='livraison_livres.php?type=livre&cne=$cne' >Go</a></button></td></tr>";        
        }
    echo '</tbody></table>';
}
?>
 

 <?php function excel_dataeleves(){
    include("ImportExcel/Classes/PHPExcel/IOFactory.php");	
    $objPHPExcel = PHPExcel_IOFactory::load('Données/eleves.xls');
    if($objPHPExcel){
    $cne="";
    $nom="";
    $prenom="";
    $sex="";
    $num=0;
    $niveau="";
    $con = mysqli_connect('localhost', 'root','');

 foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
    $worksheetTitle     = $worksheet->getTitle();
    $highestRow         = $worksheet->getHighestRow(); // e.g. 10
    $highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
    $nrColumns = ord($highestColumn) - 64;
            $cell = $worksheet->getCellByColumnAndRow(8, 11);
            $niveau = $cell->getValue();
            $annees =""; $annees .= (date('Y')-1);$annees .= "/".date('Y');
    for ($row = 16; $row <= ($highestRow-1); ++ $row) {
            $cell1 = $worksheet->getCellByColumnAndRow(26, $row);
            $cell2 = $worksheet->getCellByColumnAndRow(23, $row);
            $cell3 = $worksheet->getCellByColumnAndRow(16, $row);
            $cell4 = $worksheet->getCellByColumnAndRow(11, $row);
            $cell5 = $worksheet->getCellByColumnAndRow(12, $row);
            $num = $cell1->getValue();
            $cne = $cell2->getValue();
            $prenom = $cell3->getValue();
            $sex = $cell4->getValue();if($sex == "ذكر"){$sex="M";}else{if($sex == "أنثى" ){$sex="F" ;}}
            $nom = $cell5->getValue();
            $dataType1 = PHPExcel_Cell_DataType::dataTypeForValue($num);
            $dataType2 = PHPExcel_Cell_DataType::dataTypeForValue($cne);
            $dataType3 = PHPExcel_Cell_DataType::dataTypeForValue($prenom);
            $dataType4 = PHPExcel_Cell_DataType::dataTypeForValue($sex);
            $dataType5 = PHPExcel_Cell_DataType::dataTypeForValue($nom);
            if( ($dataType1 != NULL) && ($dataType2 != NULL) && ($dataType3 != NULL) && ($dataType4 != NULL) && ($dataType5 != NULL) ){
                $sql="INSERT INTO glsb . eleve(num,cne,prenom,nom,sex,niveau,annees) VALUES ($num,'$cne','$prenom','$nom','$sex','$niveau','$annees')";
                $rqt=mysqli_query($con,$sql);
            }
    }
}
    }
 }
 ?>
<?php
function format_aj_livre($num,$type,$nameinsert){
echo "<form method='post' action='AjouterLivre.php?type=$type&num=$num' id='aj_livre' >"; 
    if($type == "pluscopier" ){ 
?>
    <table border="0" id='aj_livre' >
      <tr><td>Titre de livre :</td><td><input type='text' name='titre' ><br/></td></tr>
      <tr><td>date publication</td><td><input type='date' name='date_publication'><br/></td></tr>
      <tr><td>langue </td><td><input list='list_langue' name='langue'><br/></td></tr>
      <tr><td>auteur :</td><td><input name='auteur' type='text' ><br/></td></tr>
      <tr><td>prix :</td><td><input type='number' value='50' name='prix'><br/></td></tr>
      <tr><td>domaine : </td><td><input list='list_domaine' name='domaine'><br/></td></tr>
    </table>
<?php echo "<div style='display:inline-flex;' >" ;
  $pr=0;for($i=1;$i<=$num;$i++){  if($i >= $pr+3 ){echo "</div><div style='display:inline-flex;' >";$pr=$i;}
?>
    <table border="0" id='aj_livre' >
      <tr><th>Code de livre <?php echo $i; ?>: </th><th><input type='text' name='<?php echo "codelivre".$i; ?>' ><br/></th></tr>
            <tr><td>faisable :</td><td><input name='<?php echo "faisable".$i; ?>' list='list_faisable' ><br/></td></tr>
    </table>
<?php }echo "<button name='$nameinsert' >Ajeuté</button></div>" ;
    }else{
        if($type == "seul" ){

?>
<?php echo "<div style='display:inline-flex;' >" ;
  $pr=0;for($i=1;$i<=$num;$i++){  if($i >= $pr+3 ){echo "</div><div style='display:inline-flex;' >";$pr=$i;}
?>
    <table border="0" id='aj_livre'>
      <tr><th>Code de livre : </th><th><input type='text' name='<?php echo "codelivre".$i; ?>' ><br/></th></tr>
      <tr><td>Titre de livre :</td><td><input type='text' name='<?php echo "titre".$i; ?>' ><br/></td></tr>
      <tr><td>date publication</td><td><input type='date' name='<?php echo "date_publication".$i; ?>'><br/></td></tr>
      <tr><td>langue </td><td><input list='list_langue' name='<?php echo "langue".$i; ?>'><br/></td></tr>
      <tr><td>auteur :</td><td><input name='<?php echo "auteur".$i; ?>' type='text' ><br/></td></tr>
      <tr><td>prix :</td><td><input type='number' value='50' name='<?php echo "prix".$i; ?>'><br/></td></tr>
      <tr><td>domaine : </td><td><input list='list_domaine' name='<?php echo "domaine".$i; ?>'><br/></td></tr>
      <tr><td>faisable :</td><td><input name='<?php echo "faisable".$i; ?>' list='list_faisable' ><br/></td></tr>
    </table>
<?php }echo "<button name='$nameinsert' >Ajeuté</button></div>" ;
        }else{
        if($type == "dossier_livre" ){
?>
    <table border="0" id='aj_livre' >
      <tr><td>langue </td><td><input list='list_langue' name='langue'><br/></td></tr>
      <tr><td>auteur :</td><td><input name='auteur' type='text' ><br/></td></tr>
    </table>
<?php echo "<div style='display:inline-flex;' >" ;
  $pr=0;for($i=1;$i<=$num;$i++){  if($i >= $pr+3 ){echo "</div><div style='display:inline-flex;' >";$pr=$i;}
?>
    <table border="0" id='aj_livre' >
      <tr><th>Code de livre <?php echo $i; ?>: </th><th><input type='text' name='<?php echo "codelivre".$i; ?>' ><br/></th></tr>
      <tr><td>Titre de livre <?php echo $i; ?> :</td><td><input type='text' name='<?php echo "titre".$i; ?>' ><br/></td></tr>
      <tr><td>prix <?php echo $i; ?> :</td><td><input type='number' value='50' name='<?php echo "prix".$i; ?>' ><br/></td></tr>
      <tr><td>faisable <?php echo $i; ?> :</td><td><input list='list_faisable' name='<?php echo "faisable".$i; ?>' ><br/></td></tr>
      <tr><td>date publication <?php echo $i; ?> </td><td><input type='date' name='<?php echo "date_publication".$i; ?>' ><br/></td></tr>
      <tr><td>domaine <?php echo $i; ?> : </td><td><input list='list_domaine' name='<?php echo "domaine".$i; ?>' ><br/></td></tr>
    </table>
<?php }echo "<button name='$nameinsert' >Ajeuté</button></div>";
        }else{
            if($type == "nouvelle_edition" ){
?>
    <table border="0" id='aj_livre'>
      <tr><th>Code de l'ancien livre : </th><th><input type='text' name='codelivreencien' ><br/></th></tr>
      <tr><th>Code de nouvell edition de livre : </th><th><input type='text' name='codelivre' ><br/></th></tr>
      <tr><td>Titre de nouvelle edition :</td><td><input type='text' name='titre' ><br/></td></tr>
      <tr><td>date publication de nouvelle edition </td><td><input type='date' name='date_publication'><br/></td></tr>
      <tr><td>prix  :</td><td><input type='number' value='50' name='prix' ><br/></td></tr>
      <tr><td>faisable nouvelle edition:</td><td><input name='faisable' list='list_faisable' ><br/></td></tr>
      <tr><td colspan="2" ><button name='<?php echo $nameinsert; ?>' >Ajeuté</button></td></tr>
    </table>
<?php
            }
        }
    }
        }
echo "</form>";
    }
?>










































 <?php /*function excel_datalivres($id_table,$nom,$prenom,$cne,$num,$sex,$niveau){
    include("ImportExcel/Classes/PHPExcel/IOFactory.php");	
    $objPHPExcel = PHPExcel_IOFactory::load('Données/livres.xls');
    if($objPHPExcel){
    $cne="";
    $nom="";
    $prenom="";
    $sex="";
    $num=0;
    $niveau="";
    $con = mysqli_connect('localhost', 'root','');
echo '<table>'; 
 foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
    $worksheetTitle     = $worksheet->getTitle();
    $highestRow         = $worksheet->getHighestRow(); // e.g. 10
    $highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
    $nrColumns = ord($highestColumn) - 64;
            $cell = $worksheet->getCellByColumnAndRow(8, 11);
            $niveau = $cell->getValue();
    for ($row = 1; $row <= ($highestRow-1); ++ $row) {
            $cell1 = $worksheet->getCellByColumnAndRow(0, $row);
            $cell2 = $worksheet->getCellByColumnAndRow(1, $row);
            $cell3 = $worksheet->getCellByColumnAndRow(2, $row);
            $cell4 = $worksheet->getCellByColumnAndRow(3, $row);
            $cell5 = $worksheet->getCellByColumnAndRow(4, $row);
            $cell6 = $worksheet->getCellByColumnAndRow(5, $row);
            $cell7 = $worksheet->getCellByColumnAndRow(6, $row);
            $cell8 = $worksheet->getCellByColumnAndRow(7, $row);
            $cell9 = $worksheet->getCellByColumnAndRow(8, $row);
             $codelivre = $cell1->getValue();
             $titre = $cell2->getValue();
             $date_publication = $cell3->getValue();
             $langue = $cell4->getValue();
             $auteur = $cell5->getValue();
             $prix = $cell6->getValue();
             $domaine = $cell7->getValue();
             $faisable = $cell8->getValue();
             $date_insertion = $cell9->getValue();
            $dataType1 = PHPExcel_Cell_DataType::dataTypeForValue($codelivre );
            $dataType2 = PHPExcel_Cell_DataType::dataTypeForValue($date_publication );
            $dataType3 = PHPExcel_Cell_DataType::dataTypeForValue($langue );
            $dataType4 = PHPExcel_Cell_DataType::dataTypeForValue($auteur );
            $dataType5 = PHPExcel_Cell_DataType::dataTypeForValue($prix);
            $dataType6 = PHPExcel_Cell_DataType::dataTypeForValue($domaine );
            $dataType7 = PHPExcel_Cell_DataType::dataTypeForValue($faisable );
            $dataType8 = PHPExcel_Cell_DataType::dataTypeForValue($date_insertion);
            if( ($dataType1 != NULL) && ($dataType2 != NULL) && ($dataType3 != NULL) && ($dataType4 != NULL) && ($dataType5 != NULL) ){
                if($row == 1 ){
             		echo "<thead style='background-color:#7FFF00;text-align:center;font-size:30px;' ><tr><th>".$codelivre ."</th><th>".$date_publication ."</th><th>".$langue ."</th><th>".$auteur ."</th><th>".$prix."</th><th>".$domaine ."</th><th>".$faisable ."</th><th>".$date_insertion."</th><th><button><a href='livraison_livres.php?type=livraison&nom=$nom&prenom=$prenom&CNE=$cne&sex=$sex&num=$num&niveau=&niveau' >Go</a></button></th></tr>";
             		echo "<tbody id='$id_table' style='background-color:#FF7F50;text-align:center;font-size:30px;' >";
                }else{
             		echo "<tr><td>".$codelivre ."</td><td>".$date_publication ."</td><td>".$langue ."</td><td>".$auteur ."</td><td>".$prix."</td><td>".$domaine ."</td><td>".$faisable ."</td><td>".$date_insertion."</td><td><button><a href='livraison_livres.php?type=validelivraison&nom=$nom&prenom=$prenom&CNE=$cne&sex=$sex&num=$num&niveau=&niveau&codelivre=$codelivre&langue=$langue&auteur=$auteur&date_publication=$date_publication&prix=$prix&domaine=$domaine&faisable=$faisable&date_insertion=$date_insertion&titre=$titre' >Go</a></button></td></tr>";               	
                }
            }
    }
}    echo '</tbody></table>';
    }
 }*/
 ?>
