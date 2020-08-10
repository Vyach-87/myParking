<?php
  $page_name='Редактирование данных клиента';
  require("my_func/head.php");
  require("my_func/connect.php");
  require('my_func/config.php');
  $edit_id = $_GET['id'];
  //echo $edit_id;
  // определили номер машины
  $query = $pdo->query("SELECT phone FROM cars WHERE reg_num='$edit_id'");
  $phone = $query->fetch(PDO::FETCH_OBJ);
  // определили номер телефона
  $car_data_arr=array();
  $cars_count=0;
  $query = $pdo->query("SELECT mark, model, body_color, reg_num, park_flag FROM cars WHERE phone='$phone->phone'");
  while($data = $query->fetch(PDO::FETCH_OBJ)) // все данные машины
  {
    $car_data=array('mark'=>$data->mark,
                    'model'=>$data->model,
                    'body_color'=>$data->body_color,
                    'reg_num'=>$data->reg_num,
                    'park_flag'=>$data->park_flag,
                );
    array_push($car_data_arr, $car_data);
    $cars_count++;
  }

  $query = $pdo->query("SELECT name, sex, addres FROM clients WHERE phone='$phone->phone'");
  $client_data = $query->fetch(PDO::FETCH_OBJ); // все данные клиента
  //$query = $pdo->query("SELECT COUNT(*) FROM cars WHERE phone='$phone->phone'");
  //$cars_count = $query->fetch(PDO::FETCH_COLUMN); // число машин клиента
  // удалили машину
?>
    <header >
        <h3 padding:10px> Редактирование данных клиента </h3>
        <hr/>
    </header>

      <form class="form_new" action='my_func/upd_new.php' method='post'>
        <form class="needs-validation" novalidate>
          <!--<div class="form-row">-->
            <div class="col-md-6 mb-3">
              <label>Фамилия Имя Отчество</label>
              <input name='client_name' type="text" class="form-control" required value='<?php echo $client_data->name ?>' >
            </div>
            <!-- Radio button "sex"-->
            <div class="col-md-6 mb-3">
              <label>Пол</label><br/>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="sex_RadioInline" name="sex_RadioInline" class="custom-control-input" value="M" <?php echo ($client_data->sex=="M")?"checked":"" ?>>
                <label class="custom-control-label" for="sex_RadioInline">мужской</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="sex_RadioInline0" name="sex_RadioInline" class="custom-control-input" value="F" <?php echo ($client_data->sex=="F")?"checked":"" ?>>
                <label class="custom-control-label" for="sex_RadioInline0">женский</label>
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <label>Телефон</label>
              <input name='client_phone' type="text" class="form-control" required readonly value=<?php echo $phone->phone ?> >
              <div class="invalid-feedback">
                Введите свой контактный телефон!
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <label>Адрес</label>
              <input name='client_addres' type="text" class="form-control" value=<?php echo $client_data->addres ?>>
            </div>

            <label class="col-md-6 mb-3">Количество автомобилей</label>
            <div class="col-md-1 mb-1">
              <input name='cars_num' type="text" class="form-control" required value=<?php echo $cars_count ?> readonly>
            </div>

            <?php
            $id=0;
            while ($id<=$cars_count)
            {
              $j=$id+1;
              ($id==$cars_count)?($req=""):($req="required");
              ($id==$cars_count)?($key_guard=""):($key_guard="readonly");
            ?>
            <hr/>
            <div class="col-md-10 mb-3">
              <label>Автомобиль #<?php echo $j,$k ?></label><br/>
              <div class="form-row">
                <div class="col-md-3 mb-2">
                  <label>Марка</label>
                  <input name='car_mark<?php echo ($id) ?>' type="text" class="form-control" <?php echo $req ?> value=<?php echo $car_data_arr[$id]['mark'] ?>>
                  <div class="invalid-feedback">
                    Введите марку!
                  </div>
                </div>
                <div class="col-md-3 mb-2">
                  <label>Модель</label>
                  <input name='car_model<?php echo ($id) ?>' type="text" class="form-control"  <?php echo $req ?> value=<?php echo $car_data_arr[$id]['model'] ?>>
                  <div class="invalid-feedback">
                    Введите модель!
                  </div>
                </div>
                <div class="col-md-3 mb-2">
                  <label>Гос.номер РФ</label>
                  <input name='car_number<?php echo ($id) ?>' type="text" class="form-control" <?php echo $req ?> <?php echo $key_guard ?> value=<?php echo $car_data_arr[$id]['reg_num'] ?>>
                  <div class="invalid-feedback">
                    Введите госномер!
                  </div>
                </div>
                <div class="col-md-3 mb-2">
                  <label>Цвет кузова</label>
                  <input name='car_color<?php echo ($id) ?>' type="text" class="form-control" <?php echo $req ?> value=<?php echo $car_data_arr[$id]['body_color'] ?>>
                  <div class="invalid-feedback">
                    Введите цвет!
                  </div>
                </div>
                <div class="col-md-6 mb-3">
                  <label>Автомобиль на стоянке</label><br/>
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="park_RadioInline<?php echo ($id) ?>" name="park_RadioInline<?php echo ($id) ?>" class="custom-control-input" value="Y" <?php echo (($car_data_arr[$id]['park_flag']=="Y")||($id==$cars_count+1))?"checked":"" ?>>
                    <label class="custom-control-label" for="park_RadioInline<?php echo ($id) ?>">Да</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="park_RadioInline2<?php echo ($id) ?>" name="park_RadioInline<?php echo ($id) ?>" class="custom-control-input" value="N" <?php echo ($car_data_arr[$id]['park_flag']=="N")?"checked":"" ?>>
                    <label class="custom-control-label" for="park_RadioInline2<?php echo ($id) ?>">Нет</label>
                  </div>
                </div>
              </div>
            </div>
            <?php
              $id++;
            }
            ?>
          <!--</div>-->
          <div class="col-md-3 mb-2">
            <button class="btn btn-primary" type="submit">Обновить</button>
          </div>
          <hr/>
          <br/>
        </form>
      </form>
  </body>
</html>
