<?php
  $page_name='Карта парковки';
  require("my_func/head.php");
  require("my_func/connect.php");
  require("my_func/config.php");
  //$query = $pdo->query("SELECT COUNT(*) FROM cars");
  //$num = $query->fetch(PDO::FETCH_COLUMN); // число записей
?>
    <header >
      <h3 padding:10px> Карта парковки </h3>
    </header>
    <hr/>
    <form class="form_new" action='#' method='post'>
      <div class="form-row align-items-center">
        <div class="col-auto my-1">
          <select class="custom-select mr-sm-2" id="Clients_row" >
            <option selected>Клиенты</option>
            <?php
            $query = $pdo->query("SELECT name, phone FROM clients");
            while($client = $query->fetch(PDO::FETCH_OBJ))
            {
              ?>
            <option value="<?php echo $client->phone ?>"><?php echo $client->name ?></option>
            <?php
            } // while
              ?>
          </select>
        </div>

        <script src="script.js"></script>

        <div class="col-auto my-1">
          <select class="custom-select mr-sm-2" id="Cars_row">
            <option selected>Автомобили</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
        </div>
        <div class="col-auto my-1">
          <button type="submit" class="btn btn-primary">Поместить на парковку</button>
        </div>
      </div>
    </form>



    <div class="main_table">
      <div class="table-responsive">
        <table class="table table-striped table-bordered">
          <thead>
            <tr> <th>#</th>
                 <th>Автомобиль</th>
                 <th>Цвет кузова</th>
                 <th>Гос номер</th>
                 <th>Убрать со стоянки</th>
             </tr>
          </thead>

          <tbody>
            <?php
              park_map();
            ?>
          </tbody>
        </table>
      </div>
    </div>

  </body>
</html>
