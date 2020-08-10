<?php
//print_r($_POST); // $POST - тут все данные)

 /* формирует главную таблицу "Все клиенты"
 / # / name / car = mark + model / number /
 $dsn='mysql:host=localhost; dbname=parking_db';
 $pdo = new PDO($dsn, 'root', 'root');
 */
 function main_table_show()
{
  $id=1;
  //$offset=0;
  //$show=10;
  require 'config.php';

  global $p_id, $lim, $pages; // текущая страница, записей на странице, всего страниц
  ($_GET['p_id']=="")?($p_id=1):($p_id=$_GET['p_id']);

  $lim=3; // записей на странице

  $query = $pdo->query("SELECT COUNT(*) FROM cars");
  $num = $query->fetch(PDO::FETCH_COLUMN); // число записей
  $pages =  intdiv($num, $lim)+1;
  $prev=$p_id-1;

  $start=$lim*$prev;
  $stop=$lim*$p_id;
  $skip=$start;
  $skip_count=0;
  // Вывод таблицы
  $query_clients = $pdo->query("SELECT name, phone FROM clients");
  while($row_clients = $query_clients->fetch(PDO::FETCH_OBJ))
  {

    $query_cars = $pdo->query("SELECT mark, model, reg_num FROM cars WHERE phone=$row_clients->phone");
    while(($row_cars = $query_cars->fetch(PDO::FETCH_OBJ))&&($start<$stop))
    {
      if($skip_count<$skip)
      {
        //print_r('skip'.$skip_count);
        //exit();
        $skip_count++;
      } else {

    ?>
      <tr> <td><?php echo $id ?></td>
           <td><?php echo $row_clients->name ?></td>
           <td><?php echo $row_cars->mark,' ', $row_cars->model ?></td>
           <td><?php echo $row_cars->reg_num ?></td>
           <td>
             <button class="btn btn-outline-info">
               <a href="edit_client.php?id=<?php echo $row_cars->reg_num ?>">
               <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-pencil" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M11.293 1.293a1 1 0 0 1 1.414 0l2 2a1 1 0 0 1 0 1.414l-9 9a1 1 0 0 1-.39.242l-3 1a1 1 0 0 1-1.266-1.265l1-3a1 1 0 0 1 .242-.391l9-9zM12 2l2 2-9 9-3 1 1-3 9-9z"/>
                  <path fill-rule="evenodd" d="M12.146 6.354l-2.5-2.5.708-.708 2.5 2.5-.707.708zM3 10v.5a.5.5 0 0 0 .5.5H4v.5a.5.5 0 0 0 .5.5H5v.5a.5.5 0 0 0 .5.5H6v-1.5a.5.5 0 0 0-.5-.5H5v-.5a.5.5 0 0 0-.5-.5H3z"/>
               </svg>

             </button>
           </td>
           <td>
             <button class="btn btn-outline-danger">
               <a href="my_func/del.php?id=<?php echo $row_cars->reg_num ?>">
                 <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-x" fill="red" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M11.854 4.146a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708-.708l7-7a.5.5 0 0 1 .708 0z"/>
                  <path fill-rule="evenodd" d="M4.146 4.146a.5.5 0 0 0 0 .708l7 7a.5.5 0 0 0 .708-.708l-7-7a.5.5 0 0 0-.708 0z"/>
                </svg>
               </a>
             </button>
           </td>
       </tr>

       <?php
       $id++;
       $start++;

      } // if..
    } // while cars
  } // while clients
} // main_table_show()
// Пагинация
function pages()
{
  global $p_id, $lim, $pages;
  /*
  $lim=1; // записей на странице - задаётся в  function main_table_show()
  require 'config.php';

  $query = $pdo->query("SELECT COUNT(*) FROM cars");
  $num = $query->fetch(PDO::FETCH_COLUMN); // число записей
  $pages =  intdiv($num, $lim)+1;

  //$p_id=$_GET['p_id']; // current page
  ($_GET['p_id']=="")?($p_id=1):($p_id=$_GET['p_id']);
  */
  $next=$p_id+1;
  $prev=$p_id-1;
  if($prev<1){$prev='';}
  if($next>$pages){$next=$pages;}
  $i=0;
  $j=$pages+1;

  ?>
  <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
      <?php
      if(($pages>1)||(0<=$p_id)||(0<=$p_id)) // страниц больше чем 1
      {
        while($i<=$j)
        {
          ($i==0)?($link='index.php?p_id='.$prev):
          (($i==$j)?($link='index.php?p_id='.$next):
          (($i==1)?($link='index.php?p_id='):($link='index.php?p_id='.$i)));
      ?>
        <li class="page-item <?php if($i==$p_id){echo 'active';} /*else if((($i==0)&&($p_id==1))||(($i=$j)&&($p_id==$pages))){echo 'disabled';}*/ ?>">
          <a class="page-link"
           href="<?php echo $link ?>" tabindex="-1"
           aria-disabled="false<?php /*(($p_id==1)||($p_id==$j))?('true'):('false') */?>">
           <?php if($i==0) {
             echo 'Назад';
           } else if ($i==($j)) {
             echo 'Вперёд';
           } else {
             echo $i;
           }
           $i++;
           ?>

          </a>
        </li>
        <?php
        }
      }
}
// Проверка данных перед вводом в БД
function data_test()
{
  global $new_name, $new_sex, $new_phone, $new_addres, $new_car_mark, $new_car_model, $new_car_num, $new_car_color, $new_car_park;
  if((3>mb_strlen($new_name))||(mb_strlen($new_name)>150))
  {
    echo "Ошибка ввода:";
    $error_name="<h1>Недопустимая длина имени!</h1>";
    echo $error_name;
    exit();
  } else if((6>mb_strlen($new_phone))||(mb_strlen($new_phone)>11)||(!(is_numeric($new_phone))))
  {
    echo "Ошибка ввода:";
    $error_name="<h1>Недопустимый номер телефона!</h1>";
    echo $error_name;
    exit();
  }

  require 'config.php';

  $query_clients = $pdo->query("SELECT name, phone FROM clients WHERE phone='$new_phone'");
  $phone_test = $query_clients->fetch(PDO::FETCH_OBJ);
  if(!$phone_test) // проверка наличия номера телефона в БД
  {
  $sql = 'INSERT INTO clients(name,sex,phone,addres) VALUES(:name,:sex,:phone,:addres)';
  $query = $pdo->prepare($sql);
  $query->execute(['name'=>$new_name,
                   'sex'=>$new_sex,
                   'phone'=>$new_phone,
                   'addres'=>$new_addres]);
  } else if($new_name!=$phone_test->name) { // Если есть проверяем совпадение имён
    echo "Ошибка ввода:";
    $error_name="<h1>Другой клиент с таким телефоном уже существует!</h1>";
    echo $error_name;
    exit();
  }
  // Если машина с таким номером уже есть в БД
  $query_cars = $pdo->query("SELECT reg_num FROM cars WHERE reg_num='$new_car_num'");
  if($reg_num_test = $query_cars->fetch(PDO::FETCH_OBJ))
  {
    echo "Ошибка ввода:";
    echo $new_car_num;
    $error_name="<h1>Машина с таким гос номером уже существует!</h1>";
    echo $error_name;
    exit();
  } else {
    $sql = 'INSERT INTO cars(phone,mark,model,body_color,reg_num,park_flag) VALUES(:phone,:mark,:model,:body_color,:reg_num,:park_flag)';
    $query = $pdo->prepare($sql);
    $query->execute(['phone'=>$new_phone,
                     'mark'=>$new_car_mark,
                     'model'=>$new_car_model,
                     'body_color'=>$new_car_color,
                     'reg_num'=>$new_car_num,
                     'park_flag'=>$new_car_park]);
  }
  return "INS";
} // data_test()
// Проверка данных перед UPDATE БД
function data_test_UPD()
{
  global $new_name, $new_sex, $new_phone, $new_addres, $new_car_mark, $new_car_model, $new_car_num, $new_car_color, $new_car_park;
  if((3>mb_strlen($new_name))||(mb_strlen($new_name)>150))
  {
    echo "Ошибка ввода:";
    $error_name="<h1>Недопустимая длина имени!</h1>";
    echo $error_name;
    exit();
  } else if((6>mb_strlen($new_phone))||(mb_strlen($new_phone)>11)||(!(is_numeric($new_phone))))
  {
    echo "Ошибка ввода:";
    $error_name="<h1>Недопустимый номер телефона!</h1>";
    echo $error_name;
    exit();
  }

  require 'config.php';

  $sql = "UPDATE clients SET name=?, sex=?, addres=? WHERE phone=?";
  $query_UPD = $pdo->prepare($sql);
  $query_UPD->execute([$new_name, $new_sex, $new_addres, $new_phone]);

  $sql = "UPDATE cars SET mark=?, model=?, body_color=?, park_flag=? WHERE reg_num=?";
  $query_UPD = $pdo->prepare($sql);
  $query_UPD->execute([$new_car_mark, $new_car_model, $new_car_color, $new_car_park, $new_car_num]);
  return "UPD";
} // data_test_UPD()

// Карта парковки
function park_map()
{
 $id=1;
 //$offset=0;
 //$show=10;
 require 'config.php';
 $query_cars = $pdo->query("SELECT mark, model, body_color, reg_num FROM cars WHERE park_flag='Y'");
 while($row_cars = $query_cars->fetch(PDO::FETCH_OBJ))
 {
   ?>
     <tr> <td><?php echo $id ?></td>
          <td><?php echo $row_cars->mark,' ',$row_cars->model ?></td>
          <td><?php echo $row_cars->body_color ?></td>
          <td><?php echo $row_cars->reg_num ?></td>
          <td><button class="btn btn-outline-danger">
                <a href="my_func/away_car.php?id=<?php echo $row_cars->reg_num ?>">
                  <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-x" fill="red" xmlns="http://www.w3.org/2000/svg">
                   <path fill-rule="evenodd" d="M11.854 4.146a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708-.708l7-7a.5.5 0 0 1 .708 0z"/>
                   <path fill-rule="evenodd" d="M4.146 4.146a.5.5 0 0 0 0 .708l7 7a.5.5 0 0 0 .708-.708l-7-7a.5.5 0 0 0-.708 0z"/>
                 </svg>
                </a>
              </button>
          </td>
      </tr>
      <?php
      $id++;
  } // while
} // park_map()
?>
