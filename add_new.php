<?php
  require 'config.php';
  require 'connect.php';

  $new_name = filter_var($_POST['client_name'], FILTER_SANITIZE_STRING);
  $new_sex = filter_var($_POST['sex_RadioInline'], FILTER_SANITIZE_STRING);
  $new_phone = filter_var($_POST['client_phone'], FILTER_SANITIZE_STRING);
  $new_addres = filter_var($_POST['client_addres'], FILTER_SANITIZE_STRING);
  $car_num = filter_var($_POST['cars_num0'], FILTER_SANITIZE_STRING);
  $new_car_mark = filter_var($_POST['car_mark0'], FILTER_SANITIZE_STRING);
  $new_car_model = filter_var($_POST['car_model0'], FILTER_SANITIZE_STRING);
  $new_car_color = filter_var($_POST['car_color0'], FILTER_SANITIZE_STRING);
  $new_car_num = filter_var($_POST['car_number0'], FILTER_SANITIZE_STRING);
  $new_car_park = filter_var($_POST['park_RadioInline0'], FILTER_SANITIZE_STRING);
  data_test();
  //$link='Location: /edit_client.php?id='.$_POST['car_number0'];
  //header($link);
  header('Location: /index.php');
?>
