
  <?php 
session_start();
$racine = $_SESSION['racine1'];
$fileName = $_SESSION['fileName'];
  if (file_exists($racine.'result/'.$fileName)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($racine.'result/'.$fileName).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($racine.'result/'.$fileName));
    readfile($racine.'result/'.$fileName);
      exit;
  }
    ?>
