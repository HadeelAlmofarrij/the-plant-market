<!DOCTYPE html>
<html>
<head>
    <title>Admin Page</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            width: 100%;
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

        .error {
            color: red;
            margin-bottom: 10px;
        }

        .logout-btn {
            width: 100%;
            padding: 8px;
            background-color: #f44336;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }

        .logout-btn:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <?php
        include 'functions.php';
        include 'config.php';

        $valid = true; // true as long as user input is valid
        $errors = array(); // array contains error messages to show to user

        // if form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $pname = test_input($_POST["pname"]);
            $image = test_input($_POST["image"]);
            $price = test_input($_POST["price"]);

            if (empty($pname)) { // check if movie name is empty
                $valid = false;
                $errors['pname'] = "You must enter a plant name.";
            }

            if (empty($image)) { // check if movie name is empty
                $valid = false;
                $errors['image'] = "You must enter a plant image.";
            }

            if (empty($price)) { // check if movie name is empty
                $valid = false;
                $errors['price'] = "You must enter a plant price.";
            }

            if ($valid) {
                $sql = "INSERT INTO product (pname, image, price) 
                        VALUES ('" . $pname . "', '" . $image  . "',  '" . $price  . "')";

                if ($conn->query($sql) === TRUE) {
                    header('Location: ListPlants.php'); // redirect to mypage.php if all info is valid
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }
    ?>

    <!-- Show error messages -->
    <span class="error">
        <?php 
            foreach($errors as $message) {
                echo "* " . htmlspecialchars($message) . "<br>"; 
            }
        ?>
    </span>

    <div class="container">
        <h2>Add a New Plant</h2>
        <form action="AdminPage.php" method="post">
            <label>Plant Name:</label>
            <input type="text" name="pname">
            <br>
            <label>Plant Image URL:</label>
            <input type="text" name="image">
            <br>
            <label>Plant Price:</label>
            <input type="text" name="price">
            <br>
            <input type="submit" name="submit" value="Add Plant">
        </form>
        <form action="logout.php" method="post">
            <input type="submit" name="logout" value="Logout" class="logout-btn">
        </form>
    </div>
</body>
</html>