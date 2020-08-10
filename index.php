      <?php
        require 'my_func/head.php';
        require 'my_func/connect.php';
        //global $name_error, $phone_error, $id_error;
        $name_error = false;
        $phone_error = false;
        $id_error = false;
      ?>
      <header >
          <h3 padding:10px> Все клиенты </h3>
      </header>
      <div class="main_table">
        <div class="table-responsive">
          <table class="table table-striped table-bordered">
            <thead>
              <tr> <th>#</th>
                   <th>ФИО</th>
                   <th>Автомобиль</th>
                   <th>Гос номер</th>
                   <th>Редактировать</th>
                   <th>Удалить</th>
               </tr>
            </thead>

            <tbody>
              <?php
                main_table_show();
              ?>
            </tbody>
          </table>
        </div>
      </div>
      <?php
      pages();
      ?>

  </body>
</html>
