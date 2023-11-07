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

                $selectUserQuery = "INSERT INTO user (name, email, password) VALUES (:name, :email, :password)";

                $registerUser = $pdo->prepare($selectUserQuery);
                
                $registerUser->bindParam(':name', $data['name']);
                $registerUser->bindParam(':email', $data['email']);
                
                $passwordCript = password_hash($data['password'], PASSWORD_DEFAULT);
                $registerUser->bindParam(':password', $passwordCript);
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
            <input type="text" minlength="3" required name="name" placeholder="Name">
            <label>Email:</label>
            <input type="text" required name="email" placeholder="Email">
            <label>Password:</label>
            <input type="password" minlength="8" maxlength="20" required name="password" placeholder="Password">
            <input type="submit" name="sendRegisterUser" value="Register">
        </form>

        <a href="index.php">Index</a>
    </main>
    <footer>

    </footer>
</body>
</html>