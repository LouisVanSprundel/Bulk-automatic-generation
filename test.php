<!DOCTYPE html>
<html>
    <head>
		  <meta charset="utf-8" />
          <title>test</title>
		  
	</head>
	<body>
        
<form method="post" action="fichier.php" enctype="multipart/form-data">
     <input type="file" name="file" id="file" /><br />
     <input type="submit" name="submit" value="Envoyer" />
</form>


<?php 
        
    

  if ($_FILES['file']['error'] > 0) $erreur = "Erreur lors du transfert";  
//vérifie l'extension du fichier
$extensions_valides = array( 'csv' );
$extension_upload = strtolower(  substr(  strrchr($_FILES['file']['name'], '.')  ,1)  );
if ( in_array($extension_upload,$extensions_valides) ){
    echo "Extension correcte";
} 
$nom = md5(uniqid(rand(), true));
$resultat = move_uploaded_file($_FILES['file']['tmp_name'],$nom);
if ($resultat) echo "Transfert réussi";


        
$path_to_file = 'C:\wamp\www\bulk\templateTest.xml';

        
  //trouve les mot entre "[]" ,les stocke dans un array et affiche les mots clé à remplacer.
$word= array ();
$file=fopen($path_to_file, 'r+') or exit("Unable to open file!");
       
while (!feof($file))
  {
      $wordNotParse=fgets($file);
  if(strpos($wordNotParse, '[') !== false){
     $word[] = strstr($wordNotParse, '[');
     $word[] = strstr($word[], ']', true);
  }
  } 
        print_r($word);
        echo "<br>";
fclose($file);

$wordUnique = array_unique($word);
print_r($wordUnique);
  //écriture dans le template      

$file_contents = file_get_contents($path_to_file);
$file_contents = str_replace("[IMSIFILLE]","20801000021",$file_contents);
file_put_contents($path_to_file,$file_contents); 
?>
    </body>
</html>
