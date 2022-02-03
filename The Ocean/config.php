<?php
    /* Database credentials. Assuming you are running MySQL
    server with default setting (user 'root' with no password) */
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'ocean');
    
    /* Attempt to connect to MySQL database */
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    
    // Check connection
    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

        #post_num, text, likes

    function addPost($text){
        $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $text = "\"$text\"";
        $sql = "INSERT INTO `posts`(`_text`, `likes`) VALUES ($text, 0)";
        if($link->query($sql)){
        }   
        $link->close();
    }

    function deletePost($post_num){
        $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $sql = "DELETE FROM posts WHERE post_num = $post_num";
        if($link->query($sql)){
        }   
        $link->close();  
    }

#posts:
#post_num, text, likes
//  1                  0->1
//  2
//  3

    function likePost($post_num){
        $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $row = mysqli_fetch_array(mysqli_query($link, "SELECT * FROM posts WHERE post_num = $post_num"));
        $likes = $row[2] + 1;
        $sql = "UPDATE posts SET likes = $likes WHERE post_num = $post_num";
        if($link->query($sql)){
        }   
        $link->close();    
    }

?>