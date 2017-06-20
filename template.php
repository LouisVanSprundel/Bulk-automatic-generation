<?php
include("./includes/header.php");
$eqpmt = $_GET['eqpmt'];
?>

<title>G&eacute;n&eacute;ration de Bulk</title>
<br><br>
<?php echo '<form name="formulaire" method="POST" action="./bulk.php?eqpmt='.$eqpmt.'">';?>
                                <label for="template">Template : </label>
                                <select name="id">
                                	<option selected="selected" value="">----------</option>
				<?php $liste_templates = scandir('./templates/'.$eqpmt);
					if ($liste_templates) {
						foreach ($liste_templates as $l) {
							if(preg_match('/.(x|sp)ml$/',$l)) {
								echo '<option value="'.$l.'">'.$l.'</option>';
							}
						} 
					}
				?>	
                                </select>
                                <br>
                                <br>
                                <input type="submit" value="OK">
                        </form>




<?php
//echo '<br><br><br><br><br><br>';
include('./includes/tailer.php');
?>
