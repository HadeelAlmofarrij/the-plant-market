<!DOCTYPE html>
<html>
<head>
    <title>Admin Page</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        h1, h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        a {
            color: #337ab7;
            text-decoration: none;
            margin-right: 10px;
        }

        button {
            padding: 6px 12px;
            background-color: #5cb85c;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #449d44;
        }

        #updateForm {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            padding: 8px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <?php
        // Connect to the database
        $database_name = "Product_details";
        $con = mysqli_connect("localhost", "root", "", $database_name);

        // Handle delete operation
        if (isset($_GET["delete"]) && isset($_GET["id"])) {
            $product_id = $_GET["id"];
            $query = "DELETE FROM product WHERE id = $product_id";
            mysqli_query($con, $query);

            // Redirect to a page after deletion
            header("Location: ListPlants.php");
            exit();
        }

        // Handle update operation
        if (isset($_POST["update"]) && isset($_POST["id"])) {
            $product_id = $_POST["id"];
            $new_product_name = $_POST["pname"];
            $new_image = $_POST["image"];
            $new_price = $_POST["price"];

            $query = "UPDATE product SET pname = '$new_product_name', image = '$new_image', price = $new_price WHERE id = $product_id";
            mysqli_query($con, $query);

            // Redirect to a page after updating
            header("Location: ListPlants.php");
            exit();
        }

        // Retrieve all products from the database
        $query = "SELECT * FROM product";
        $result = mysqli_query($con, $query);

        // Close the database connection
        mysqli_close($con);
    ?>

    <h1>Admin Page</h1>

    <h2>Product List</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Product Image</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row["id"]; ?></td>
                    <td><?php echo $row["pname"]; ?></td>
                    <td><?php echo $row["image"]; ?></td>
                    <td><?php echo $row["price"]; ?></td>
                    <td>
                        <a href="ListPlants.php?delete=true&id=<?php echo $row["id"]; ?>">Delete</a>
                        <button onclick="showUpdateForm(<?php echo $row["id"]; ?>, '<?php echo $row["pname"]; ?>', '<?php echo $row["image"]; ?>', <?php echo $row["price"]; ?>)">Update</button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <h2>Update Product</h2>
    <form id="updateForm" style="display: none;" method="post" action="ListPlants.php">
        <input type="hidden" name="id" id="updatePlantId">
        <label for="updatePlantName">Product Name:</label>
        <input type="text" name="pname" id="updatePlantName">
        <label for="updateImage">Product Image:</label>
        <input type="text" name="image" id="updateImage">
        <label for="updatePrice">Price:</label>
        <input type="number" name="price" id="updatePrice">
        <input type="submit" name="update" value="Update">
    </form>

    <script>
        function showUpdateForm(id, pname, image, price) {
            document.getElementById("updatePlantId").value = id;
            document.getElementById("updatePlantName").value = pname;
            document.getElementById("updateImage").value = image;
            document.getElementById("updatePrice").value = price;
            document.getElementById("updateForm").style.display = "block";
        }
    </script>
</body>
</html>