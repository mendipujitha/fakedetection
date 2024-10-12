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
                                    <a href="./food-items-list.php" class="nav-link">Food Items</a>
                                </li>
                                <?php
                                  if($_SESSION['is_admin']){
                                    echo <<<_END
                                      <li class="nav-item">
                                          <a href="./delete-food.php" class="nav-link">Delete Food Details</a>
                                      </li>
_END;
                                  }
                                ?>

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
                $food_id = $_GET['food_id'];
                $_SESSION['food_id'] = $food_id;
                $query = "SELECT * FROM food_item WHERE food_item.item_id = $food_id";
                // print_r($query);
                $result = $conn->query($query);
                // print_r($result);
                $rowCount = $result->num_rows;
                for($loop=0; $loop< $rowCount; $loop++){
                  $result->data_seek($loop);
                  $row = $result->fetch_array(MYSQLI_NUM);
                  // print_r($row);
                  echo <<<_END
                      <div class="col-md-12">
                          <form class="form" action="./update-food-details.php?food_id=$food_id" method="post">
                              <span class="form-title">
                                   Food details
                              </span>
                              <div class="div-input">
                                  <span class="label-input100">Food Name</span>
                                  <input class="input100" type="text" name="name" value="$row[1]">
                              </div>
                              <div class="div-input">
                                  <span class="label-input100">Food Type</span>
                                  <input class="input100" type="text" name="type" value="$row[2]">
                              </div>
                              <div class="div-input">
                                  <span class="label-input100">Price</span>
                                  <input class="input100" type="text" name="price" value="$row[3]">
                              </div>
                              <div class="div-input">
                                  <span class="label-input100">Description</span>
                                  <input class="input100" type="text" name="description" value="$row[5]">
                              </div>
                              <div class="div-input">
                                  <span class="label-input100">Ingredients</span>
                                  <textarea class="input100" name="ingredients">
                                    $row[6]
                                  </textarea>
                              </div>
                              <div class="div-input">
                                  <span class="label-input100">Food Image</span>
                                  <input class="input100" type="text" name="image" value="$row[4]">
                              </div>

                              <div class="container-contact100-form-btn">
                                  <button type="submit" class="contact100-form-btn">
                                      Update food
                                  </button>
                              </div>
                          </form>
                      </div>
_END;
                }

                  if(isset($_POST)){
                    echo '<br>';
                    // print_r($_POST);
                    $name = $_POST['name'];
                    $type = $_POST['type'];
                    $price = $_POST['price'];
                    $description = $_POST['description'];
                    $ingredients = $_POST['ingredients'];
                    $image = $_POST['image'];

                    $query = "UPDATE food_item SET item_name = '$name', item_type='$type', price='$price', item_image='$image', description='$description', ingredients='$ingredients' WHERE item_id = $food_id";
                    echo '<br>';
                    // print_r($query);
                    $result = $conn->query($query);
                    // print_r($result);
                  }

              ?>
            </div>
        </div>
    </body>
</html>
