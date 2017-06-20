<?php
class ExceptionParameter extends Exception
{
  public function __construct($message, $code = 0)
  {
    parent::__construct($message, $code);
  }
  
  public function __toString()
  {
    return $this->message;
  }
}

class ExceptionIMSI extends Exception
{
  public function __construct($message, $code = 0)
  {
    parent::__construct($message, $code);
  }
  
  public function __toString()
  {
    return $this->message;
  }
}

class ExceptionMSISDN extends Exception
{
  public function __construct($message, $code = 0)
  {
    parent::__construct($message, $code);
  }
  
  public function __toString()
  {
    return $this->message;
  }
}


function checkElements($reference, $tab){
    $compare = array();
    $result = array();
    for($a=0;$a<sizeof($tab);$a++){
        $compare[$a] = $tab[$a][0];
    }  
    $result = array_diff($reference, $compare);
    if(sizeof($result) !=0){   
    throw new ExceptionParameter('les parametres d\'entr&eacute;es ne correspondent pas a ceux demand&eacute;s (verifiez la synthaxe des noms des champs, Majuscule, minuscule...)'); 
}
}



function checkIMSI($tab){
    $erreur = array();
    $p =0;
      for($a=0;$a<sizeof($tab);$a++){
        $compare[$a] = $tab[$a][0];
    }  
    $key = array_search( "IMSI" , $compare);
   // echo $key;
    if($key !== false){
        for($i=1;$i<count($tab[1]);$i++){
            if (!preg_match('/^20801[0-9]{10}$/',$tab[$key][$i])){
               $erreur[$p] =  $compare[$key]." incorrecte ligne ".$i." (".$tab[$key][$i].")#";
                $p++;
            }
        }
       $erreurs = implode("#",$erreur);
      $erreurs = str_replace('#', '<br>', $erreurs);
     if(!empty($erreurs)){
         throw new ExceptionIMSI($erreurs);
     }   
}
}

function checkIMSIFILLE($tab){
    $erreur = array();
    $p =0;
      for($a=0;$a<sizeof($tab);$a++){
        $compare[$a] = $tab[$a][0];
    }  
    $key = array_search( "IMSIFILLE" , $compare);
   // echo $key;
    if($key !== false){
        for($i=1;$i<count($tab[1]);$i++){
            if (!preg_match('/^20801[0-9]{10}$/',$tab[$key][$i])){
               $erreur[$p] =  $compare[$key]." incorrecte ligne ".$i." (".$tab[$key][$i].")#";
                $p++;
            }
        }
       $erreurs = implode("#",$erreur);
      $erreurs = str_replace('#', '<br>', $erreurs);
     if(!empty($erreurs)){
         throw new ExceptionIMSI($erreurs);
     }   
}
}

function checkIMSIMERE($tab){
    $erreur = array();
    $p =0;
      for($a=0;$a<sizeof($tab);$a++){
        $compare[$a] = $tab[$a][0];
    }  
    $key = array_search( "IMSIMERE" , $compare);
   // echo $key;
    if($key !== false){
        for($i=1;$i<count($tab[1]);$i++){
            if (!preg_match('/^20801[0-9]{10}$/',$tab[$key][$i])){
               $erreur[$p] =  $compare[$key]." incorrecte ligne ".$i." (".$tab[$key][$i].")#";
                $p++;
            }
        }
       $erreurs = implode("#",$erreur);
      $erreurs = str_replace('#', '<br>', $erreurs);
     if(!empty($erreurs)){
         throw new ExceptionIMSI($erreurs);
     }   
}
}

function checkMSISDN($tab){
    $erreur = array();
    $k= 0;
      for($a=0;$a<sizeof($tab);$a++){
        $compare[$a] = $tab[$a][0];
    } 
    $key = array_search( "MSISDN" , $compare);
    //echo $key;
    if($key !== false){
        for($i=1;$i<count($tab[1]);$i++){
            if (!preg_match('/^(33[67][0-9]{8})|(33700[0-9]{10})$/',$tab[$key][$i])){
               $erreur[$k] =  $compare[$key]." incorrecte ligne ".$i." (".$tab[$key][$i].")#";
                $k++;

            }
        }
        $erreurs = implode("#",$erreur);
        $erreurs = str_replace('#', '<br>', $erreurs);
       
        if(!empty($erreurs)){
         throw new ExceptionMSISDN($erreurs);
     }   
}
}

function checkMSISDNFILLE($tab){
    $erreur = array();
    $k= 0;
      for($a=0;$a<sizeof($tab);$a++){
        $compare[$a] = $tab[$a][0];
    } 
    $key = array_search( "MSISDNFILLE" , $compare);
    //echo $key;
    if($key !== false){
        for($i=1;$i<count($tab[1]);$i++){
            if (!preg_match('/^(33[67][0-9]{8})|(33700[0-9]{10})$/',$tab[$key][$i])){
               $erreur[$k] =  $compare[$key]." incorrecte ligne ".$i." (".$tab[$key][$i].")#";
                $k++;

            }
        }
        $erreurs = implode("#",$erreur);
        $erreurs = str_replace('#', '<br>', $erreurs);
       
        if(!empty($erreurs)){
         throw new ExceptionMSISDN($erreurs);
     }   
}
}

function checkMSISDNMERE($tab){
    $erreur = array();
    $k= 0;
      for($a=0;$a<sizeof($tab);$a++){
        $compare[$a] = $tab[$a][0];
    } 
    $key = array_search( "MSISDNMERE" , $compare);
   // echo $key;
    if($key !== false){
        for($i=1;$i<count($tab[1]);$i++){
            if (!preg_match('/^(33[67][0-9]{8})|(33700[0-9]{10})$/',$tab[$key][$i])){
               $erreur[$k] =  $key.$compare[$key]." incorrecte ligne ".$i." (".$tab[$key][$i].")#";
                $k++;

            }
        }
        $erreurs = implode("#",$erreur);
        $erreurs = str_replace('#', '<br>', $erreurs);
       
        if(!empty($erreurs)){
         throw new ExceptionMSISDN($erreurs);
     }   
}
}



?>
