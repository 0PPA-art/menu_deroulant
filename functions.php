<?php
include_once 'bdd.php';

  
  function get_all_records(){
    $bdd = getdb();
    $Sql = "SELECT * FROM ordinateur";
    $result = mysqli_query($bdd, $Sql);  
    if (mysqli_num_rows($result) > 0) {
     echo "<div class='table-responsive'><table id='myTable' class='table table-striped table-bordered'>
             <thead><tr><th>ID</th>
                          <th>Last_Inventory</th>
                          <th>Computer</th>
                          <th>User</th>
                          <th>Operating_Systeme</th>
                          <th>RAM_MB</th>
                          <th>CPU_MHz</th>
                        </tr></thead><tbody>";
     while($row = mysqli_fetch_assoc($result)) {
         echo "<tr><td>" . $row['id']."</td>
                   <td>" . $row['Last_inventory']."</td>
                   <td>" . $row['Computer']."</td>
                   <td>" . $row['User']."</td>
                   <td>" . $row['Operating_system']."</td>
                   <td>" . $row['RAM_MB']."</td>
                   <td>" . $row['CPU_MHz']."</td></tr>";        
     }
    
     echo "</tbody></table></div>";
     
} else {
     echo "you have no records";
}
}
 ?>