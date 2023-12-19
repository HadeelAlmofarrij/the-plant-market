<?php

			$nameError = "";
			$passwordError = "";
            $emailError = "";
			$isValid = true;

			$error = "";

			if($_SERVER["REQUEST_METHOD"] == "POST") {

				$username = $_POST["username"];
				$password =  $_POST["password"];
                $email = $_POST["email"];
				
			
				// validation

				if(empty($username)) {
					$nameError ="Name is required.";
					$error = "Name is required."; 
					$isValid = false;
				} 
				else if (strlen($username) < 8) {
					$nameError =  "UserName must be at least eight characters long.";
					$errors[] = "UserName must be at least eight characters long.";
					$isValid = false;
				  }
			  
				else if (!preg_match("/^[a-zA-Z]*[0-9]*$/", $username)) {
					$nameError = "Name can contain only letters and numbers.";
					$error = "Name can contain only letters and numbers.";
					$isValid = false;
				}

				if(empty($email)) {
					$emailError = "Email is required.";
					$error = "Email is required.";
					$isValid = false;
				} 
				else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					$emailError = "Invalid email format.";
					$error ="Invalid email format.";
					$isValid = false;}
	
					if(empty($password)) {
						$passwordError = "Password is required.";
						$error = "Password is required.";
						$isValid = false;
					} 
					  else if (strlen($password) < 8) {
						$passwordError = "Password must be at least eight characters long.";
						$errors[] = "Password must be at least eight characters long.";
						$isValid = false;
					  }
				  
					else if (!preg_match('/[A-Za-z]/', $password) || !preg_match('/[0-9]/', $password) || !preg_match('/[^A-Za-z0-9]/', $password)) {
						$passwordError ="Password must contain at least one letter, one number, and one special character.";
						$errors[] = "Password must contain at least one letter, one number, and one special character.";
						$isValid = false;  
					}


				if ($isValid == true) {

			
$connection = mysqli_connect("localhost", "root", "", "users");
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];


$query = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";


$result = mysqli_query($connection, $query);
if (!$result) {
    die("Query execution failed: " . mysqli_error($connection));
}

mysqli_close($connection);

					// redirect the user to a different page
					$redirectUrl = 'ProductsPage.php';
					$redirectUrl .= '?username=' . urlencode($username);
					$redirectUrl .= '&email=' . urlencode($email);
					$redirectUrl .= '&password=' . urlencode($password);
					header('Location: ' . $redirectUrl);
					exit;
				}
			}
			
	?>
<!DOCTYPE html>
<html >
<head>
   <link rel="StyleSheet" type="text/css" href="StyleSheet.css">
    <title>SignUp Page</title>
	<style>
    body {
      background-color: #f5f5f5;
      font-family: Arial, sans-serif;
    }

    #signup-container {
      width: 400px;
      margin: 100px auto;
      padding: 20px;
      background-color: #ffffff;
      border: 1px solid #dddddd;
      border-radius: 5px;
      box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
    }

    h1 {
      text-align: center;
      color: #333333;
      font-size: 28px;
      margin-bottom: 30px;
    }

    label {
      display: block;
      font-size: 14px;
      font-weight: bold;
      color: #555555;
      margin-bottom: 10px;
    }

    input[type="text"],
    input[type="password"],
    input[type="email"] {
      width: 90%;
      padding: 10px;
      font-size: 14px;
      border: 1px solid #dddddd;
      border-radius: 3px;
      margin-bottom: 20px;
    }

    .error {
      color: red;
      font-size: 12px;
      margin-bottom: 10px;
    }

    .btn {
      display: block;
      width: 100%;
      padding: 10px;
      background-color: #4CAF50;
      color: #ffffff;
      font-size: 16px;
      text-align: center;
      border: none;
      border-radius: 3px;
      cursor: pointer;
    }

    .btn:hover {
      background-color: #45a049;
    }

  
  </style>

</head>
<body>


<div id="signup-container">
    <h1>Sign Up</h1>
    <form method="POST" action="">
      <label for="username">Username:</label>
      <input type="text" name="username" id="username" required>
      <span class="error"><?php echo $nameError; ?></span>

      <label for="email">Email:</label>
      <input type="email" name="email" id="email" required>
      <span class="error"><?php echo $emailError; ?></span>

      <label for="password">Password:</label>
      <input type="password" name="password" id="password" required>
      <span class="error"><?php echo $passwordError; ?></span>

      <input type="submit" value="Sign Up" class="btn">
      <label for="GoToLogin">DO you have an axisting account ?</label> <a href="login.php">Login </a>
    </form>
  </div>
 
</body>
</html>