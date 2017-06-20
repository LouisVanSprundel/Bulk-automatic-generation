<title>G&eacute;n&eacute;ration de Bulk</title>
<br><br
        <?php
   ini_set( "display_errors", 0);  
  include("./includes/header.php");      
    include("./checkFile.php");  

  if ($_FILES['file']['error'] > 0) $erreur = "Erreur lors du transfert";  
//vérifie l'extension du fichier
$extensions_valides = array( 'csv', 'xls', 'xlsx' );
$extension_upload = strtolower(  substr(  strrchr($_FILES['file']['name'], '.')  ,1)  );
$file=$_FILES['file']['name'];
$nom = md5(uniqid(rand(), true));
$nom = $nom.".csv";
$resultat = move_uploaded_file($_FILES['file']['tmp_name'],$nom);
if($extension_upload == "xls" || $extension_upload == "xlsx" ){
    require_once 'PHPExcel-develop/Classes/PHPExcel/IOFactory.php';
$excel = PHPExcel_IOFactory::load($nom);


$excel->getActiveSheet()
    ->getStyle( $excel->getActiveSheet()->calculateWorksheetDimension())
    ->getNumberFormat()
    ->setFormatCode(
        PHPExcel_Style_NumberFormat::FORMAT_NUMBER
    ); 
$writer = PHPExcel_IOFactory::createWriter($excel, 'CSV');
$writer->setDelimiter(";");
$writer->setEnclosure(""); 
$writer->save($nom);
}


if ( in_array($extension_upload,$extensions_valides) ){



//lit les lignes du csv et les stocke dans un array deux dimensions
$row = 0;
$somme = 0;
$tab = array (array());
if (($handle = fopen($nom, "r")) !== FALSE) {
  while (($data = fgetcsv($handle, 0, ";")) !== FALSE) {  
     for($i=0;$i<count($data);$i++){
               $somme = $somme + strlen($data[$i]);  
        
          } 
      if($somme != 0){
          for($i=0;$i<count($data);$i++){
                $tab[$i][$row]=$data[$i];  
        
          }  
          $row++;
  }
  $somme = 0;
  }
    fclose($handle);
    
}

session_start();
$reference = $_SESSION['temp'];
$path_to_file = $_SESSION['template']; 
$templateName = $_SESSION['templateName'];
$compare= array();
    
      
try{
checkElements($reference, $tab);
checkIMSI($tab); 
checkMSISDN($tab);
checkIMSIFILLE($tab);
checkIMSIMERE($tab);
checkMSISDNFILLE($tab);
checkMSISDNMERE($tab);
    
$first = sizeof($tab);
$second = count($tab[1]);
//écriture dans le template   
$date = trim(shell_exec('date +"%Y%m%d%H%M%S"')); 
$fileName = $date.$templateName;
$file_contents = file_get_contents("includes/begin.xml");
file_put_contents($racine.'result/'.$fileName, $file_contents);


 for($r=1;$r <$row;$r++){ 
   $file_contents = file_get_contents($path_to_file);
    for($p=0; $p<sizeof($tab); $p++){
        
        $file_contents = str_replace('['.$tab[$p][0].']',trim($tab[$p][$r]),$file_contents);
        
    }
      
     file_put_contents($racine.'result/'.$fileName, $file_contents, FILE_APPEND); 
     //$fileName = date('Ymdhms').$templateName;
 }
    
     
     $_SESSION['fileName'] = $fileName;  
     $end = file_get_contents("includes/end.xml");
     file_put_contents($racine.'result/'.$fileName, $end , FILE_APPEND);
     
    unlink($nom);
    echo "Bulks realis&eacute;s avec succes, disponible sous : ".$racine.'result/';
    echo "<br>";
  //  echo '<a href="./result/'.$fileName.'"><img src="./images/dl.jpg" height="25" width="25" alt="dl"/> T&eacute;l&eacute;charger le bulk</a></h3>';
    echo '<a href="download.php"><img src="./images/dl.jpg" height="25" width="25" alt="dl"/> T&eacute;l&eacute;charger le bulk</a></h3>';
    // $downloadFile = $racine."/resutl/".$fileName;
    // echo '<a href="./result/'.$fileName.'"><img src="./images/dl.jpg" height="25" width="25" alt="dl"/> Visu xml</a></h3>';    
/* for($r=1;$r <$row;$r++){ 
     $file_contents = file_get_contents($path_to_file);
    for($p=0; $p<sizeof($tab); $p++){
     
        $file_contents = str_replace('['.$tab[$p][0].']',$tab[$p][$r],$file_contents);
        
    }
     $fileName = date('Ymdhms').$templateName;
     file_put_contents($racine.'result/'.$fileName, $file_contents, FILE_APPEND); 
     $_SESSION['fileName'] = $fileName;
 }
    
    unlink($nom);
    echo "Bulks realises avec succes, disponible sous : ".$racine.'result/';
    echo "<br>";
  //  echo '<a href="./result/'.$fileName.'"><img src="./images/dl.jpg" height="25" width="25" alt="dl"/> T&eacute;l&eacute;charger le bulk</a></h3>';
    echo '<a href="download.php"><img src="./images/dl.jpg" height="25" width="25" alt="dl"/> T&eacute;l&eacute;charger le bulk</a></h3>';
    */
    

   
    
}catch (ExceptionParameter $parameters){
    unlink($nom);
     echo $parameters;
}catch (ExceptionIMSI $imsi){
    unlink($nom);
    echo $imsi;
}catch (ExceptionMSISDN $msisdn){
    unlink($nom);
    echo $msisdn;
}
    
} else {
    echo "extension incorrecte, veuillez recommencer";
}

include('./includes/tailer.php');
?>
