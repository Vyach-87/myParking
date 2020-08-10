<?php
  require 'config.php';
  require 'connect.php';

  $new_name = filter_var($_POST['client_name'] /*FILTER_SANITIZE_STRING*/);
  $new_sex = filter_var($_POST['sex_RadioInline'], FILTER_SANITIZE_STRING);
  $new_phone = filter_var($_POST['client_phone'], FILTER_SANITIZE_STRING);
  $new_addres = filter_var($_POST['client_addres'], FILTER_SANITIZE_STRING);
  $car_num = filter_var($_POST['cars_num'], FILTER_SANITIZE_STRING);
  $i=0;
  $j=$car_num;
  while($i<=$j)
  {
    $new_car_mark = filter_var($_POST['car_mark'.$i], FILTER_SANITIZE_STRING);
    $new_car_model = filter_var($_POST['car_model'.$i], FILTER_SANITIZE_STRING);
    $new_car_color = filter_var($_POST['car_color'.$i], FILTER_SANITIZE_STRING);
    $new_car_num = filter_var($_POST['car_number'.$i], FILTER_SANITIZE_STRING);
    $new_car_park = filter_var($_POST['park_RadioInline'.$i], FILTER_SANITIZE_STRING);
    (($i==$j)&&($new_car_num!=""))?(data_test()):(data_test_UPD());
    //($i==$j)?(print_r(data_test())):(print_r(data_test_UPD()));
    $i++;
  }
  header('Location: /index.php');
?>
