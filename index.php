<?php

session_start();

$first_name = "";
$last_name = "";
$email = "";
$phone = "";
$address = "";

$fname_err = "";
$Lname_err = "";
$email_err = "";
$pass_err = "";
$Cpass_err = "";


$error = false;

IF($_SERVER['REQUEST_METHOD'] == 'POST'){
    $first_name = $_POST['fname'];
    $last_name = $_POST['Lname'];
    $email = $_POST['em'];
    $password = $_POST['pass'];
    $confirmed_pass = $_POST['Cpass'];




    if(empty($first_name)){
        $fname_err = "First Name is required.";
        $error = true;
    }
    if(empty($last_name)){
        $Lname_err = "Last Name is required.";
        $error = true;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_err = "Email format invalid.";
        $error = true;
    }
    

    include "tools/db.php";
    $dbConnection = getDBConnection();

    $statement = $dbConnection->prepare("SELECT id FROM users WHERE email = ?");
    $statement->bind_param("s", $email);

    $statement->execute();


    $statement->store_result();
    if ($statement->num_rows > 0){
        $email_err = "Email already used.";
        $error = true;
    }

    $statement->close();

    if(strlen($password) < 6){
        $pass_err = "Password must be greater than 7 characters.";
        $error = true;
    }
    if($confirmed_pass != $password){
        $Cpass_err = "Passwords do not match.";
        $error = true;
    }


    if(!$error){
        $password = password_hash($password, PASSWORD_DEFAULT);
        $created_at = date('Y-m-d H:i:s');

        $statement = $dbConnection->prepare(
            "INSERT INTO users (first_name, last_name, email, password, created_at) ".
            "VALUES (?,?,?,?,?)"
        );

    $statement->bind_param('sssss', $first_name,$last_name,$email,$password,$created_at);

    $statement->execute();

    $insert_id = $statement->insert_id;
    $statement->close();



    $_SESSION["id"] = $insert_id;
    $_SESSION["first_name"] = $first_name;
    $_SESSION["last_name"] = $last_name;
    $_SESSION["email"] = $email;
    $_SESSION["created_at"] = $created_at;

    header("Location: login.php");
    exit();
    }
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Booking - Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }
        .login-container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        input {
            display: block;
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }
        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head> n       
<body>

    <div class="login-container">
        <h2>Grand Stay Hotel Login</h2>
        <form method="post" id="loginForm">
                        <label for="fname">First Name:</label>
                        <input type="text" id="fname" name="fname" value="<?= $first_name; ?>" required>
                        <p class="error" id="errorMessage"><?= $fname_err;?></p>

                        <label for="Lname">Last Name:</label>
                        <input type="text" id="Lname" name="Lname" value="<?= $last_name; ?>" required>
                        <p class="error" id="errorMessage"><?= $Lname_err;?></p>
            
                        <label for="em">Email Address:</label>
                        <input type="email" id="em" name="em" value="<?= $email; ?>" required>
                        <p class="error" id="errorMessage"><?= $email_err;?></p>

                        <label for="pass">Password:</label>
                        <input type="password" id="pass" name="pass" required>
                        <p class="error" id="errorMessage"><?= $pass_err;?></p>
            
                        <label for="Cpass">Confirm Password:</label>
                        <input type="password" id="Cpass" name="Cpass" required>
                        <p class="error" id="errorMessage"><?= $Cpass_err;?></p>

                        <button type="submit">Register</button>
                        <a href="./login.php">
                        <button type="button">Have an Account? Log In</button>
                    </a> 
        </form>        
    </div>
</body>
</html>
