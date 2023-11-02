<?php 

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
            var_dump($data);

            if (!empty($data['signIn'])) {
                var_dump($data);
            }
        ?>

        <form action="" method="POST">
            <label> Email: </label>
            <input type="text" name="email" placeholder="Email"><br>

            <label>Password</label>
            <input type="password" name="password" placeholder="Password"><br>

            <input type="submit" name="signIn" value="Enter">
        </form>
    </main>
</body>
</html>