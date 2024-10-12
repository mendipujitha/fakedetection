<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

    <head>
    <meta charset="utf-8">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

        <title>Zomato - Update</title>
        <link rel="stylesheet" href="../styles/food-details.css">
        <link rel="stylesheet" href="../styles/styles.css">
    </head>

    <body>
        <!-- <header>
            <a href="./food-items-list.php" id="deleteMovieBtn" class="btn btn-primary">Delete food details</a>
        </header> -->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                        <a class="navbar-brand" href="./resturant-list.php">Zomato</a>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a href="./resturant-delete.php" class="nav-link">Delete resturant details</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
              <?php
              require_once './db_connection.php';
              $conn = new mysqli($hn, $un, $pw, $db);
              // print_r($conn);
              echo '<br>';
              $resturantId = $_GET['res_id'];
              $_SESSION['res_id'] = $resturantId;
              $query="SELECT * FROM resturant WHERE resturant_id = '$resturantId'";
              $result = $conn->query($query);
              // print_r($result);
              if(!$result) die($conn->connect_error);

              $rowCount = $result->num_rows;
              // echo $rowCount;
              for($loop = 0; $loop< $rowCount; $loop++){
                $result->data_seek($loop);
                $row = $result->fetch_array(MYSQLI_NUM);
                // print_r($res_id);
                // print_r($row);
                echo <<<_END
                    <div class="col-md-12">
                        <form class="form" method="post" action="./update-resturant-details.php?res_id=$resturantId">
                          <span class="form-title">
                              Update resturant
                          </span>

                          <div class="div-input">
                              <span class="label-input100">Resturant Name</span>
                              <input class="input100" type="text" name="name" value="$row[1]">
                          </div>
                          <div class="div-input">
                              <span class="label-input100">Cuisine(s)</span>
                              <input class="input100" type="text" name="cuisine" value="$row[3]">
                          </div>
                          <div class="div-input">
                              <span class="label-input100">Address</span>
                              <textarea class="input100" name="address">
                                  $row[2]
                              </textarea>
                          </div>
                          <div class="div-input">
                              <span class="label-input100">Opening Time</span>
                              <input class="input100" type="time" name="open" value="$row[5]">
                          </div>
                          <div class="div-input">
                              <span class="label-input100">Closing Time</span>
                              <input class="input100" type="time" name="close" value="$row[6]">
                          </div>
                          <div class="div-input">
                              <span class="label-input100">Logo</span>
                              <input class="input100" type="text" name="logo" value="$row[7]">
                          </div>

                          <div class="container-contact100-form-btn">
                              <button type="submit" class="contact100-form-btn">
                                  Update resturant
                              </button>
                          </div>
                      </form>
                    </div>
_END;
              }

              if(isset($_POST)){
                $name=$_POST['name'];
                $address=$_POST['address'];
                $cuisine=$_POST['cuisine'];
                $open=$_POST['open'];
                $close=$_POST['close'];
                $logo=$_POST['logo'];

                $updateQuery = "UPDATE resturant SET resturant_name = '$name', address = '$address', cuisine = '$cuisine', start_time = '$open', close_time = '$close', logo = '$logo') WHERE resturant_id = '$resturantId'";
                echo '<br>';
                // print_r($updateQuery);
                $updateResult = $conn->query($updateQuery);
                // print_r($updateResult);
                if(!$updateResult) die($conn->connect_error);
              }

              ?>
            </div>
        </div>
    </body>
</html>

<!-- <div class="div-input">
    <span class="label-input100">Phone Number</span>

    <input class="input100" type="tel" id="phone" name="phone" value=""
       pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required>
    <span class="note">Format: 801-800-1234</span>
</div> -->
