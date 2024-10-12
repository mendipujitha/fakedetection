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
        <header>
            <!-- <a href="./food-items-list.php" id="deleteMovieBtn" class="btn btn-primary">Delete food details</a> -->
        </header>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                        <a class="navbar-brand" href="./resturant-list.php">Zomato</a>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav">
                                <!-- <li class="nav-item active">
                                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                                </li> -->
                                <li class="nav-item">
                                    <a href="./food-items-list.php" class="nav-link">Food Items</a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a href="./update-food-details.php" class="nav-link">Update Food Details</a>
                                </li> -->
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <form class="form" action="./add-food-details.php" method="post">
                        <span class="form-title">
                            Add food item
                        </span>
                        <div class="div-input">
                            <span class="label-input100">Food Name</span>
                            <input class="input100" type="text" name="name" value="">
                        </div>
                        <div class="div-input">
                            <span class="label-input100">Food Type</span>
                            <input class="input100" type="text" name="type" value="">
                        </div>
                        <div class="div-input">
                            <span class="label-input100">Price</span>
                            <input class="input100" type="text" name="price" value="">
                        </div>
                        <div class="div-input">
                            <span class="label-input100">Description</span>
                            <input class="input100" type="text" name="description" value="">
                        </div>
                        <div class="div-input">
                            <span class="label-input100">Ingredients</span>
                            <textarea class="input100" name="ingredients">

                            </textarea>
                        </div>
                        <div class="div-input">
                            <span class="label-input100">Food Image</span>
                            <input class="input100" type="text" name="image" value="">
                        </div>

                        <div class="container-contact100-form-btn">
                            <button type="submit" class="contact100-form-btn">
                                Add food
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>

<?php
  require_once './db_connection.php';
  $conn = new mysqli($hn, $un, $pw, $db);
  if($conn->connect_error) die("connection failed " .$conn->connect_error);
  if(isset($_POST)){
      $name = $_POST['name'];
      $type = $_POST['type'];
      $price = $_POST['price'];
      $description = $_POST['description'];
      $ingredients = $_POST['ingredients'];
      $image = $_POST['image'];
  }
  // print_r($_POST);

  $query = "INSERT INTO food_item (item_name, item_type, price, item_image, description, ingredients)
     VALUES ('$name', '$type', '$price', '$image', '$description', '$ingredients')";
     // print_r($query);
     // echo '<br>';
 		$result = $conn->query($query);

 		if($result){
 			header("Location: ./food-items-list.php");
      exit();
 		} else{
 			die($conn->connect_error);
 		}


?>
