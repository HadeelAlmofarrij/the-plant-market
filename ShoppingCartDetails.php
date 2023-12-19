<?php
    session_start();
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <metahttp-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shopping Cart Details</title>
<style>
    #prudpage {
      font-size: 25px;  
    }
    img {

        width: 15%;
        float: left;
    }

body {
    background-color: lightgreen;
}
</style>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="StyleSheet" type="text/css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>
</head>
<body>
<img src="cart.jpg"alt="plant in a cart "> 
    <div class="container" style="width: 65%">
        <h2>Shopping Cart Details</h2>
        <table class="table table-bordered">
            <tr>
                <th width="40%">Item Name</th>
                <th width="10%">Quantity</th>
                <th width="20%">Price</th>
                <th width="15%">Total</th>
                <th width="5%">Action</th>
            </tr>
            <?php
                if(!empty($_SESSION["cart"])){
                    $total = 0;
                    foreach ($_SESSION["cart"] as $key => $value) {
            ?>
            <tr>
                <td><?php echo $value["item_name"]; ?></td>
                <td><?php echo $value["item_quantity"]; ?></td>
                <td>$ <?php echo $value["product_price"]; ?></td>
                <td>$ <?php echo number_format($value["item_quantity"] * $value["product_price"], 2); ?></td>
                <td><a href="ProductsPage.php?action=delete&id=<?php echo $value["product_id"]; ?>"><span class="text-danger">Remove</span></a></td>
            </tr>
            <?php
                        $total = $total + ($value["item_quantity"] * $value["product_price"]);
                    }
            ?>
            <tr>
                <td colspan="3" align="right">Total</td>
                <td align="right">$ <?php echo number_format($total, 2); ?></td>
                <td></td>
            </tr>
            <?php
                }
            ?>
        </table>
        <a id="prudpage" href="ProductsPage.php">Continue Shopping</a>
    </div>
</body>
</html>