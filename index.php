<?php
include_once 'bdd.php';
require 'functions.php';

$bdd = getdb();

if(isset($_POST["Import"])){
    
    $filename=$_FILES["file"]["tmp_name"];
    echo $filename;    
    if($_FILES["file"]["size"] > 0){
        $file = fopen($filename, "r");
        $b_error = false;
        while (($getData = fgetcsv($file, 10000, ";")) !== FALSE){

            try {
                $sql = "INSERT into inventaire (id,Last_inventory,Computer,User,Operating_system, RAM_MB, CPU_MHz) 
                values ('".$getData[0]."','".$getData[1]."','".$getData[2]."','".$getData[3]."','".$getData[4]."','".$getData[5]."','".$getData[6]."')";
                $result = mysqli_query($bdd, $sql);
            }
            catch (exception $e){
                $b_error = true;
                echo $e->getMessage();
            }
            
        }
        if($b_error) {
            echo "Invalid File:Please Upload CSV File";    
        }else{
            echo "Le fichier CSV a bien été importé !";
        }
            
        fclose($file);  
    }
}

?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Inventaire</title>
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>

</head>
<body>
    <div id="wrap">
        <div class="container">
            <div class="row">
                <form class="form-horizontal" action="index.php" method="post" name="upload_excel" enctype="multipart/form-data">
                    <fieldset>
                        <!-- Form Name -->
                        <legend>Form Name</legend>
                        <!-- File Button -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="filebutton">Select File</label>
                            <div class="col-md-4">
                                <input type="file" name="file" id="file" class="input-large">
                            </div>
                        </div>
                        <!-- Button -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="singlebutton">Import data</label>
                            <div class="col-md-4">
                                <button type="submit" id="submit" name="Import" class="btn btn-primary button-loading" data-loading-text="Loading...">Import</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            <?php
            get_all_records();
            ?>
        </div>
    </div>
</body>
</html>

<script>
    $(document).ready( function () {
    $('#myTable').DataTable( {
        language: {
            processing:     "Traitement en cours...",
            search:         "Rechercher&nbsp;:",
            lengthMenu:    "Afficher _MENU_ &eacute;l&eacute;ments",
            info:           "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
            infoEmpty:      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
            infoFiltered:   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
            infoPostFix:    "",
            loadingRecords: "Chargement en cours...",
            zeroRecords:    "Aucun &eacute;l&eacute;ment &agrave; afficher",
            emptyTable:     "Aucune donnee disponible dans le tableau",
            paginate: {
                first:      "Premier",
                previous:   "Pr&eacute;c&eacute;dent",
                next:       "Suivant",
                last:       "Dernier"
            },
            aria: {
                sortAscending:  ": activer pour trier la colonne par ordre croissant",
                sortDescending: ": activer pour trier la colonne par ordre decroissant"
            }
        },
        searching: true,
        ordering:  true
    });  
    } );
    //liste deroulante 
</script>

<label for="">quel colonne:</label>

<select name="Operating_system" id="Op_sys">
    <?php

    $o =  mysqli_query($bdd,"SELECT DISTINCT Operating_system  FROM inventaire" ); // faire une selection distinctif de la colonne op_sys dans l'inventaire
    
    $sresult = "";// 

    while ($data = $o->fetch_array()){  // tant que la variable data est egale a $o qui est flecher sur la ligne 
        $r = $data[0];      //alors $r est egale a la premiere caractere de la variable data
        $sresult = $sresult."<option value=$r >$r </option>" ;
        
    }
    
    echo $sresult;
    mysqli_query("SELECT Operating_system FROM inventaire WHERE 10")
    ?>
    

</select>