<?php
    session_start();
    $database_name = "Product_details";
    $con = mysqli_connect("localhost","root","",$database_name);

    if (isset($_POST["add"])){
        if (isset($_SESSION["cart"])){
            $item_array_id = array_column($_SESSION["cart"],"product_id");
            if (!in_array($_GET["id"],$item_array_id)){
                $count = count($_SESSION["cart"]);
                $item_array = array(
                    'product_id' => $_GET["id"],
                    'item_name' => $_POST["hidden_name"],
                    'product_price' => $_POST["hidden_price"],
                    'item_quantity' => $_POST["quantity"],
                );
                $_SESSION["cart"][$count] = $item_array;
                echo '<script>window.location="ProductsPage.php"</script>';
            }else{
                echo '<script>alert("Product is already added to the Cart")</script>';
                echo '<script>window.location="ProductsPage.php"</script>';
            }
        }else{
            $item_array = array(
                'product_id' => $_GET["id"],
                'item_name' => $_POST["hidden_name"],
                'product_price' => $_POST["hidden_price"],
                'item_quantity' => $_POST["quantity"],
            );
            $_SESSION["cart"][0] = $item_array;
        }
    }

    if (isset($_GET["action"])){
        if ($_GET["action"] == "delete"){
            foreach ($_SESSION["cart"] as $keys => $value){
                if ($value["product_id"] == $_GET["id"]){
                    unset($_SESSION["cart"][$keys]);
                    echo '<script>alert("Product has been removed from the Cart")</script>';
                  
                }
            }
        }
    }
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Products Page</title>
    <style>
 @import url('https://fonts.googleapis.com/css?family=Titillium+Web');

*{
    font-family: 'Titillium Web', sans-serif;
}

.container {
width: 65%;
}

#viewCart{

    font-size: 40px;
    margin-left: 350px;
    margin-bottom: 50px;

}



#logout{
    
    font-size: 25px;
    margin-left: 400px;
    margin-bottom: 50px;
}
</style>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="styleSheet" type="text/css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>
</head>
<body>



    <div class="container" style="width: 65%">
        <h2>Shopping Cart</h2>
        <?php
            $query = "SELECT * FROM product";
            $result = mysqli_query($con, $query);
            if(mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) {
        ?>
        <div class="col-md-3">
            <form method="post" action="ProductsPage.php?action=add&id=<?php echo $row["id"]; ?>">
                <div class="product">
                    <img src="<?php echo $row["image"]; ?>" class="img-responsive">
                    <h5 class="text-info"><?php echo $row["pname"]; ?></h5>
                    <h5 class="text-danger"><?php echo $row["price"]; ?></h5>
                    <input type="text" name="quantity" class="form-control" value="1">
                    <input type="hidden" name="hidden_name" value="<?php echo $row["pname"]; ?>">
                    <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>">
                    <input type="submit" name="add" style="margin-top: 5px;" class="btn btn-success" value="Add to Cart">
                </div>
            </form>
        </div>
        <?php
                }
            }
        ?>
        <div style="clear: both"></div>
        <a id="viewCart" href="ShoppingCartDetails.php">View Cart</a> <br>
        <a id="logout" href="logout.php">logout</a>
    </div>
</body>
</html>