<?php
    session_start();
    require_once('config.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        if(isset($_POST['password'])){
            $password = $_POST['password'];
            if(password_verify($password, "$2y$10\$dW7uyg/vS3wddmSsPWRRpuCvDtH3uy/Q9LSnxBf7YWBydCkJTSnXy")){
                $_SESSION['admin'] = "true";
            }else{
                $_SESSION['admin'] = "false";
            }
        }
        if(isset($_POST['delete_post'])){
            deletePost($_POST['delete_post']);
        }
        header("location: admin.php");
        exit();
    }
?>