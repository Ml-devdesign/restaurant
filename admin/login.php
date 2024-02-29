<?php 
    require_once $_SERVER["DOCUMENT_ROOT"] ."/admin/include/connect.php";
    if (isset($_POST['login']) && isset($_POST['password'])){
        $sql = "SELECT * FROM employees WHERE last_name=:login";
        $stmt = $db->prepare($sql);
        $stmt ->execute([':login' => $_POST["login"]]);

        if ($row = $stmt -> fetch()){
            if (password_verify($_POST['password'], $row['password_hash'])) {
                session_start();
                $_SESSION["user_connected"] = "ok";
                header("Location: /admin/administrateurs/index.php");
                exit();
            }   
            
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="login">
        <h1>Login</h1>
       <form action="login.php" method="POST">
            <div class="username">
                <label for="ok1"></label>
                <input type="text" placeholder="username" name="login" id="ok1">
            </div>
            <div class="password">
                <label for="ok2"></label>
                <input type="password" placeholder="password" name="password" id="ok2">
            </div>
            <div class="submit">
                <input type="submit" value="ok">
            </div>
            <!-- <div class="register">
                <a href="register.php">Register</a>
            </div>
            <div class="forget">
                <a href="forget.php">Forget Password</a>
            </div>
            <div class="error">
         <?php
                    if (isset($_SESSION['error'])) {
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    }
             ?>       -->

             </div>
             <div class="success">
                <?php
                    if (isset($_SESSION['success'])) {
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                    }
           ?>
            </div>  
       </form>
    </div>
</body>
</html>