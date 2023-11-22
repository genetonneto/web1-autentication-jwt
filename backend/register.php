<?php 
session_start();
include_once 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <header>
    <h1>Register User</h1>
    </header>
    <main>
        <?php 
            $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            if (!empty($data['sendRegisterUser'])) {
                // var_dump($data);

                $selectUserQuery = "INSERT INTO user (use_name, use_email, use_password) VALUES (:use_name, :use_email, :use_password)";

                $registerUser = $pdo->prepare($selectUserQuery);
                
                $registerUser->bindParam(':use_name', $data['use_name']);
                $registerUser->bindParam(':use_email', $data['use_email']);
                
                $passwordCript = password_hash($data['use_password'], PASSWORD_DEFAULT);
                $registerUser->bindParam(':use_password', $passwordCript);
                $registerUser->execute();

                if ($registerUser->rowCount()) {
                    header("Location: index.php");
                    // $_SESSION['msg'] = "<p> User registered successfully </p>";
                } else {
                    echo "User has not been registered";
                }
            }
        ?>

        <form action="" method="POST">
            <label>Name:</label>
            <input type="text" minlength="3" required name="use_name" placeholder="Name">
            <label>Email:</label>
            <input type="text" required name="use_email" placeholder="Email">
            <label>Password:</label>
            <input type="password" minlength="8" maxlength="20" required name="use_password" placeholder="Password">
            <input type="submit" name="sendRegisterUser" value="Register">
        </form>

        <a href="index.php">Index</a>
    </main>
    <footer>

    </footer>
</body>
</html>