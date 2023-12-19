

<?php
    //session_start(); 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Log In</title>
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
            transform: scale(1.5);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
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

        .create-account {
            text-align: center;
            margin-top: 10px;
        }

        .create-account a {
            color: #4CAF50;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Log In</h2>
        <form action="login.php" method="post">
        <?php
    $connection = mysqli_connect("localhost", "root", "", "users");
    if (!$connection) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $query = "SELECT * FROM users WHERE username = '$username'";

        $result = mysqli_query($connection, $query);

        if (!$result) {
            die("Query execution failed: " . mysqli_error($connection));
        }


		if ($username == 'MainAdmin1' && $password == 'Admin-1234') {
			// Redirect the user to the Admin homepage
			header("Location: AdminPage.php");
			exit;} 

        // Check if a matching user was found
        if (mysqli_num_rows($result) == 1) {
            // Fetch the user data
            $row = mysqli_fetch_assoc($result);

            // Verify the password

			

            if ($password == $row['password']) {
                
					
                    // Redirect the user to a different page (e.g., welcome.php)
                    header("Location: ProductsPage.php");
                    exit;
                
            } else {
                // Password is incorrect
                echo "Invalid password";
            }
        } else {
            // User not found
            echo "User not found";
        }
    }

    mysqli_close($connection);
?>

            <label for="username">Username</label>
            <input type="text" name="username" required>
            <br/>
            <label for="password">Password</label>
            <input type="password" name="password" required>
            <br />
            <input type="submit" name="submit" value="Log In">
            <div class="create-account">
                <label for="MakeAccount">Don't have an account?</label> <a href="SignUp.php">Make one!</a>
            </div>
        </form>
    </div>
</body>
</html>