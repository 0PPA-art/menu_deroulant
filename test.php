<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Document sans titre</title>
</head>
<body>

<select name="liste_numerique_jours">
<?php
for ($i = 1; $i <= 30; $i++)
  
{
  
echo '<option value="'.$i.'">'.$i.'</option>';
  
}
?>
<select/>  	
<select name="liste_numerique_mois">
<?php
for ($i = 1; $i <= 12; $i++)
  
{
  
echo '<option value="'.$i.'">'.$i.'</option>';
  
}
  
?>
<select/>		
<select name="liste_numerique_annee">
  


<?php
  
for ($i = 2014; $i <= 2023; $i++)
  
{
  
echo '<option value="'.$i.'">'.$i.'</option>';
  
}
?>
<select/>



</input>
<?php



$file = "test.csv";
$row = 2;
if (($handle = fopen($file, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
        $num = count($data);
        echo "<p> $num fields in line $row: <br /></p>\n";

        //Pour la date regarder du côté de la fonction Dateformat
        


       
echo'</select></td>';
        

        $row++;
        for ($c=0; $c < $num; $c++) {
            echo $data[$c] . "<br />\n";
        }
    }
    fclose($handle);
}


?>      
<?php
try{ 
  $bdd = new PDO('mysql:host=localhost;dbname=projet', 'root', ''); 
}
catch(Exception $e) 
{
       die('Erreur : '.$e->getMessage());
}
?>
<form method="post" action="traitement.php">
        <label for="pays">Dans quel pays habitez-vous ?</label><br />
        <select name="pays" id="pays">
<?php
$reponse = $bdd->query('SELECT * FROM pays');
while ($donnees = $reponse->fetch())
{
?>
            <option value="<?php echo $donnees['pays']; ?>"> <?php echo $donnees['nom']; ?></option>
<?php
}
?>
</select>
</form>
</body>
</html>