<?php
  require 'config.php';
  $del_id = $_GET['id'];

  // определили номер телефона
  $query = $pdo->query("SELECT phone FROM cars WHERE reg_num='$del_id'");
  $phone_cars = $query->fetch(PDO::FETCH_OBJ);
  // удалили машину

  $del_sql_cars = 'DELETE FROM cars WHERE reg_num=?';
  $query_cars = $pdo->prepare($del_sql_cars);
  $query_cars->execute([$del_id]);

  //echo $row_cars->phone;
  // проверили наличие других машин владельца

  $query = $pdo->query("SELECT phone FROM cars WHERE phone=$phone_cars->phone");
  if (!($del_cars = $query->fetch(PDO::FETCH_OBJ))) // не нашли
  {
    // удаляем владельца
    $del_sql_clients = 'DELETE FROM clients WHERE phone=?';
    $query_clients = $pdo->prepare($del_sql_clients);
    $query_clients->execute([$phone_cars->phone]);
  }
// на главную
  header('Location: /');
?>
