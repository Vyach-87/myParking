<?php
  $page_name='Новый клиент';
  require("my_func/head.php");
  require("my_func/connect.php");
?>
    <header >
        <h3 padding:10px> Новый клиент </h3>
        <hr/>
    </header>

      <form class="form_new" action='my_func/add_new.php?id=' method='post'>
        <form class="needs-validation" novalidate>
          <!--<div class="form-row">-->
            <div class="col-md-6 mb-3">
              <label>Фамилия Имя Отчество</label>
              <input name='client_name' type="text" class="form-control" placeholder='от 3 до 150 символов' required>
            </div>
            <!-- Radio button "sex"-->
            <div class="col-md-6 mb-3">
              <label>Пол</label><br/>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="sex_RadioInline" name="sex_RadioInline" class="custom-control-input" value="M" checked>
                <label class="custom-control-label" for="sex_RadioInline">мужской</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="sex_RadioInline0" name="sex_RadioInline" class="custom-control-input" value="F">
                <label class="custom-control-label" for="sex_RadioInline0">женский</label>
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <label>Телефон</label>
              <input name='client_phone' type="text" class="form-control" placeholder="89091234567" required>
              <div class="invalid-feedback">
                Введите свой контактный телефон!
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <label>Адрес</label>
              <input name='client_addres' type="text" class="form-control" Value=" ">
            </div>
          <!--   <label class="col-md-6 mb-3">Количество автомобилей</label>
            <div class="col-md-1 mb-1">
              <input name='cars_num0' type="text" class="form-control" value=1 required>
            </div>-->
            <hr/>
            <div class="col-md-10 mb-3">
              <label>Автомобиль</label><br/>
              <div class="form-row">
                <div class="col-md-3 mb-2">
                  <label>Марка</label>
                  <input name='car_mark0' type="text" class="form-control" required>
                  <div class="invalid-feedback">
                    Введите марку!
                  </div>
                </div>
                <div class="col-md-3 mb-2">
                  <label>Модель</label>
                  <input name='car_model0' type="text" class="form-control" required>
                  <div class="invalid-feedback">
                    Введите модель!
                  </div>
                </div>
                <div class="col-md-3 mb-2">
                  <label>Гос.номер РФ</label>
                  <input name='car_number0' type="text" class="form-control" required>
                  <div class="invalid-feedback">
                    Введите госномер!
                  </div>
                </div>
                <div class="col-md-3 mb-2">
                  <label>Цвет кузова</label>
                  <input name='car_color0' type="text" class="form-control" required>
                  <div class="invalid-feedback">
                    Введите цвет!
                  </div>
                </div>
                <div class="col-md-6 mb-3">
                  <label>Автомобиль на стоянке</label><br/>
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="park_RadioInline0" name="park_RadioInline0" class="custom-control-input" value="Y" checked>
                    <label class="custom-control-label" for="park_RadioInline0">Да</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="park_RadioInline20" name="park_RadioInline0" class="custom-control-input" value="N">
                    <label class="custom-control-label" for="park_RadioInline20">Нет</label>
                  </div>
                </div>

              </div>
            </div>
          <!--</div>-->
          <div class="col-md-3 mb-2">
            <button class="btn btn-primary" type="submit">Сохранить</button>
          </div>
          <hr/>
          <br/>
        </form>
      </form>
  </body>
</html>
