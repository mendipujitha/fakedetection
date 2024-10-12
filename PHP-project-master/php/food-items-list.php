<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta charset="utf-8">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <link rel="stylesheet" href="../styles/food-items-list.css">
        <link rel="stylesheet" href="../styles/styles.css">

        <title>Zomato</title>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                        <a class="navbar-brand" href="./resturant-list.php">Zomato</a>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav">
                              <?php
                                // $firstname = $_SESSION['firstname'];
                                // print_r($firstname);
                              if($_SESSION['is_admin']){
                                  echo <<<_END
                                      <li class="nav-item">
                                          <a href="./add-food-details.php" class="nav-link">Add Food Details</a>
                                      </li>
_END;

                                }
                                ?>
                                 <!-- <li class="nav-item">
                                     <a href="./add-food-details.php" class="nav-link">Add Food Details</a>
                                 </li> -->
                                <li class="nav-item" style="float:right">
                                    <a class="nav-link" href="./home.php">Logout</a>
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
                  if($conn->connect_error) die($conn->connect_error);

                  $query = "SELECT * FROM food_item";
                  $result = $conn->query($query);
                  // print_r($result);
                  $rows = $result->num_rows;

                  for($loop=0; $loop< $rows; $loop++){
                    $result->data_seek($loop);
                    $row = $result->fetch_array(MYSQLI_NUM);
                    // print_r($row);
                    echo <<<_END
                        <div class="col-6 col-md-3">
                            <a href="./update-food-details.php?food_id=$row[0]">
                                <div class="card">
                                    <img src="$row[4]" alt="$row[1]" class="card-img-top">
                                    <div class="card-body">
                                        <a href="./update-food-details.php?food_id=$row[0]" class="card-text"> <center> $row[1] - $row[3] $ </center> </a>
                                    </div>
                                </div>
                            </a>
                        </div>
_END;
                  }

                ?>
                <!-- <div class="col-6 col-md-3">
                    <a href="./update-food-details.php">
                        <div class="card">
                            <img src="../images/chicken-pizza.jpg" alt="Chicken Pizza" class="card-img-top">
                            <div class="card-body">
                                <a href="./update-food-details.php" class="card-text"> <center>Chicken Pizza </center> </a>
                            </div>
                        </div>
                    </a>
                </div> -->

            </div>
        </div>
    </body>
</html>
