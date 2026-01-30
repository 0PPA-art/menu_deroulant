<?php
function getdb(){
$servername = "localhost";
$username = "root";
$password = "";
$db = "ordinateur";
try {
    
    $bdd = mysqli_connect($servername, $username, $password, $db);
     echo "Connected successfully"; 
}
catch(PDOexception $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
    return $bdd;
    
}
?>