
<?php
    require '../includes/database-connection.php';
    require '../includes/functions.php';
    session_start();
    if(isset($_POST['login'])){
        $username = $_POST['txtUser'];
        $password = $_POST['txtPassword'];
        $sql = "SELECT * FROM `user` WHERE username = '$username' AND password = '$password'";
        //$record = pdo($pdo, $sql)->fetchAll();
        if($record){
            $_SESSION['username'] = $username;
            header('location: index.php');
        }else{
            header("Location: ../login.php?error='Invalid user or pass'");

        }
    }

?>