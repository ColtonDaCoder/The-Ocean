<?php
    session_start();
    require_once('config.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['post_number'])){
            header('location: main.php#post_location'.$_POST['post_number'].'');
            likePost($_POST['post_number']);
        }
        if(isset($_POST['post'])){
            $text = $_POST['post'];
            addPost($text);
            header('location: main.php');
        }
        exit;     
    }
?>