<?php

session_start();


$email = "";
$error = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = trim($_POST['em-auth']);
    $password = trim($_POST['pass-auth']);

    if(empty($email) || empty($password)){
        $error = "Email and/or Password is required.";
    } else{
        include "tools/db.php";
        $dbConnection = getDBConnection();
     
        $statement = $dbConnection->prepare(
            "SELECT id, first_name, last_name, password, created_at FROM users WHERE email = ?"
        );

        $statement->bind_param('s',$email);
        $statement->execute();

        $statement->bind_result($id, $first_name, $last_name, $stored_password, $created_at);
        
        if($statement->fetch()){
            if(password_verify($password,$stored_password)){
                $_SESSION["id"] = $id;
                $_SESSION["first_name"] = $first_name;
                $_SESSION["last_name"] = $last_name;
                $_SESSION["email"] = $email;
                $_SESSION["createdAt"] = $created_at;
                
                header("location: ./menu.php");
                exit;
            } else {
                $error = "Email or Password Invalid";
            }
        } else {
            $error = "Email or Password Invalid";
        }
        
        $statement->close();
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
            <label for="em-auth">Email Address:</label>
            <input type="email" id="em-auth" name="em-auth" value="<?= $email; ?>" required>
            <label for="pass-auth">Password:</label>
            <input type="password" id="pass-auth" name="pass-auth" required>
            <p class="error" id="errorMessage"><?= $error;?></p>
            <button type="submit" id="loginBtn">Login</button>
            <a href="./index.php"> <button type="button" id="loginBtn">Create an Account</button> </a>
        </form>
    </div>


</body>
</html>
