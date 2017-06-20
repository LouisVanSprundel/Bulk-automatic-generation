<?php
include("./includes/header.php");

$eqpmt = $_GET["eqpmt"];
$template = $racine.'/templates/'.$eqpmt.'/'.$_POST["id"];
$templateName = $_POST["id"];
session_start();
$_SESSION['template'] = $template;
$_SESSION['templateName'] = $templateName;
$_SESSION['racine1'] = $racine;

/*$parametres = shell_exec()
preg_match_all('`<z>(.*)</z>`Us',$texte,$reg)*/
    
  //trouve les mots entre "[]" ,les stocke dans un array et affiche les mots clé à remplacer.
$word= array ();
$file=fopen($template, 'r+') or exit("Unable to open file!");
       
$a =0;
while (!feof($file))
  {
      $wordNotParse=fgets($file);
   if(strpos($wordNotParse, '[') !== false){
       $word1 = explode('[', $wordNotParse);
    for ($i=0; $i<count($word1);$i++){
        if(strpos($word1[$i], ']') !== false){
         $word[$a] = strtok($word1[$i], ']');
            $a++;
        }      
        }
     }
            
   }


         
fclose($file);

$wordUnique = array_unique($word);
$wordUnique = array_values($wordUnique);
echo "<div class=\"import\">";
echo "les donn&eacute;es a transmettre sont les suivantes:";
$temp = array();
for ($i=0;$i<count($wordUnique);$i++){
    echo "<br>";
    echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp- ".$wordUnique[$i];

}
$_SESSION['temp'] = $wordUnique;

?>
<title>G&eacute;n&eacute;ration de Bulk</title>
<br><br>

<?php 
    
    
    

?>

<form method="post" action="fichier.php" enctype="multipart/form-data">
    <label for="mon_fichier">Fichier xls, xlsx et csv uniquement:</label><br />
     <input type="file" name="file" id="file" /><br />
     <input type="submit" name="submit" value="Envoyer" />
</form>
</div>
<br><br><br>
<div class="modop">
<img src="images/modopBulk.PNG">

</div>
<?php


	include("./includes/tailer.php");
?>



