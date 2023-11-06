<?php
session_start();
include_once 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <header>
        <h1>Login</h1>
    </header>
    <main>

        <?php
        // echo password_hash('123456', PASSWORD_DEFAULT);

        $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        // var_dump($data);

        if (!empty($data['signIn'])) {
            // var_dump($data);

            $selectUserQuery = "SELECT id, name, email, password
					FROM user
					WHERE email =:email
					LIMIT 1";

            $resultUser = $pdo->prepare($selectUserQuery);
            $resultUser->bindParam(':email', $data['email']);
            $resultUser->execute();

            if (($resultUser) && ($resultUser->rowCount() != 0)) {
                $rowUser = $resultUser->fetch(PDO::FETCH_ASSOC);
                // var_dump($rowUser);

                if (password_verify($data['password'], $rowUser['password'])) {

                    // Header
                    $header = [
                        'alg' => 'HS256',
                        'typ' => 'JWT'
                    ];
                    // var_dump($header);

                    $header = json_encode($header);
                    // var_dump($header);

                    $header = base64_encode($header);
                    // var_dump($header);

                    // Payload

                    $expTime = time() + (7 * 24 * 60 * 60);

                    $payload = [
                        // 'iss' => 'localhost', // Domain API
                        // 'aud' => 'localhost',
                        'exp' => $expTime,
                        'id' => $rowUser['id'],
                    ];

                    $payload = json_encode($payload);
                    // var_dump($payload);

                    $payload = base64_encode($payload);
                    // var_dump($payload);

                    // Signature

                    $key = "JR3rKQea7lgvtOM5wXCD";

                    $signature = hash_hmac('sha256', "$header.$payload", $key, true);

                    $signature = base64_encode($signature);
                    // var_dump($signature);

                    echo "<p> Token: $header.$payload.$signature </p>";

                    setcookie('token', "$header.$payload.$signature", time() + (7 * 24 * 60 * 60));
                    header('Location: home.php');

                } else {
                    $_SESSION['msg'] = "<p> Error: Incorrect email or password </p>";
                }

            } else {
                $_SESSION['msg'] = "<p> Error: Incorrect email or password </p>";
            }
        }
       
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
       
       ?>

        <?php 
            $email = "";
            if (isset($data['email'])) {
                $email = $data['email'];
            }
        ?>

        <form action="" method="POST">
            <label> Email: </label>
            <input type="text" name="email" placeholder="Email" value="<?= $email ?>"><br>

        <?php
        $password = "";
        if (isset($data['password'])) {
            $password = $data['password'];
        }
        ?>
            <label>Password</label>
            <input type="password" name="password" placeholder="Password" value="<?= $password ?>"><br>

            <input type="submit" name="signIn" value="Enter">
        </form>
    </main>
</body>
</html>