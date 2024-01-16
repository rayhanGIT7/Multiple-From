<?php
  include 'db.php'; 
  
$get_id = $_REQUEST['id'];

$check ="DELETE FROM employee_info WHERE id=$get_id";

  $run_DLquery=mysqli_query($database_connection,$check);
  if ($run_DLquery==true) {
    ?>
    <script>
    alert("DELETE SUCCESSFUL !");
    window.location.replace("index.php");
  </script>
  <?php
  }
?>