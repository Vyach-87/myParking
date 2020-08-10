<?php
  require 'config.php';
  $away_id = $_GET['id'];

  $sql = "UPDATE cars SET park_flag=? WHERE reg_num=?";
  $query = $pdo->prepare($sql);
  $query->execute(["N", $away_id]);
// на главную
  header('Location: /parking_map.php');
?>
