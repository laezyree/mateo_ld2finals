<!DOCTYPE html>
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
        <form id="loginForm">
            <input type="text" id="username" placeholder="Username" required>
            <input type="password" id="password" placeholder="Password" required>
            <button type="submit" id="loginBtn">Login</button>
            <p class="error" id="errorMessage"></p>
        </form>
    </div>

    <script>
        const correctUsername = "admin";
        const correctPassword = "password123";
        let loginButton = document.getElementById("loginBtn");
        let errorMessage = document.getElementById("errorMessage");

        document.getElementById("loginForm").addEventListener("submit", function(event) {
            event.preventDefault();

            let enteredUsername = document.getElementById("username").value;
            let enteredPassword = document.getElementById("password").value;

            if (enteredUsername === correctUsername && enteredPassword === correctPassword) {
                alert("Login successful! Redirecting...");
                window.location.href = "home.html"; // Change this to your actual redirect page
            } else {
                errorMessage.textContent = "Incorrect username or password. Please try again.";
                loginButton.disabled = true;

                setTimeout(() => {
                    loginButton.disabled = false;
                    errorMessage.textContent = "";
                }, 10000); // 10 seconds delay
            }
        });
    </script>

</body>
</html>
