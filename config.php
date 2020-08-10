<?php
  $dsn='mysql:host=localhost; dbname=parking_db';
  $pdo = new PDO($dsn, 'root', 'root',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
?>
