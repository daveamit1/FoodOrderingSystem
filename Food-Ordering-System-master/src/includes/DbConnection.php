<?php
  // 1. Create a database connection
  Define("DB_SERVER","localhost");
  Define("DB_USER","root");
  Define("DB_PASS","");
  Define("DB_NAME","foodorder");

  $connection = @mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
  mysqli_select_db($connection,DB_NAME);
  
?>
