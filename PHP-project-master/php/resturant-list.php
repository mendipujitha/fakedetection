<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
         <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

          <!--Fontawesome CDN-->
          <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="../styles/resturant-list.css">
        <link rel="stylesheet" href="../styles/styles.css">
        <title>Resturants</title>
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
                                $firstname = $_SESSION['firstname'];
                                // print_r($firstname);
                              if($_SESSION['is_admin']){
                                  echo <<<_END
                                      <li class="nav-item">
                                          <a href="./add-resturant.php" class="nav-link">Add Resturant</a>
                                      </li>
_END;

                            }

                                echo <<<_END
                                  <li class="nav-item">
                                      <a href="#" class="nav-link">Welcome $firstname</a>
                                  </li>
_END;


                    ?>

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
                <div class="col-md-11">
                  <?php
                  require_once './db_connection.php';
                  $conn = new mysqli($hn, $un, $pw, $db);
                  // print_r($conn);
                  echo '<br>';

                  $query="SELECT * FROM resturant";
                  $result = $conn->query($query);

                  // print_r($result);

                  if(!$result) die($conn->connect_error);

                  $rowCount = $result->num_rows;
                  // echo $rowCount;
                  for($loop = 0; $loop< $rowCount; $loop++){
                    $result->data_seek($loop);
                    $row = $result->fetch_array(MYSQLI_NUM);
                    // print_r($row);
                    echo <<<_END
                        <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <img src="$row[7]" alt="$row[1]">
                                </div>
                                <div class="col-md-9">
                                    <a href="./resturant-details.php?res_id=$row[0]"><h4>$row[1]</h4></a>
                                    <address>
                                        <p>$row[2]</p>
                                    </address>
                                </div>
                            </div>
                            <hr>
                            <div class="row ml-100">
                                <div class="col-md-10">
                                   <p><span>CUISINES: <span> <span id="card-values">$row[3]</span></p>
                                   <p><span>HOURS: </span><span id="card-timing">$row[5] - $row[6] (Mon-Sun)</span></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row ml-100 align-items-center">
                                <div class="col-md-5 mb-50">
                                    <a href="tel:+1 $row[4]" class="last-row">
                                   <span><i class="fas fa-phone"></i></span><b> Call</b>
                                    </a>
                                </div>
                                <div class="col-md-5 mb-50">
                                    <a href="./food-items-list.php" class="last-row">
                                       <span><i class="fas fa-bars"></i></span> <b> View Menu</b>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
_END;
                  }
                  ?>
                </div>
            </div>
        </div>
    </body>
</html>
