
<?php
    session_start();
    require_once('config.php');

    // if($_SESSION["loggedin"] == true){
    //     $_SESSION["wedges"] = $link->query("SELECT wedges FROM users WHERE id = " .$_SESSION["id"])->fetch_object()->wedges;
    // }else{
    //     header("location: wallet.php");
    //     exit;
    // }
    

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        if(isset($_POST['post_number'])){
            likePost($_POST['post_number']);
        }
        if(isset($_POST['post'])){
            $text = $_POST['post'];
            addPost($text);
        }
        
    }
?>


<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta name="language" content="English">
        <title>The Ocean | Main</title>
        <link rel="stylesheet" href="style.css">
        <link rel="icon" href="pics/favicon.ico"/>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
    </head>
    <body onload="onload()" style="background-color: whitesmoke;">
        <br><br><br><br><br><br>
        <div>
            <?php

                $loops = 0;
                $result = mysqli_query($link, "SELECT post_num, _text, likes FROM posts ORDER BY likes DESC");
                while (($row = mysqli_fetch_array($result)) && ($loops <= 10)) { 
                    echo '<p>'.$row["_text"].'</p>';
                    echo '
                    <form action="main.php" method="POST" style="width:50px;" >
                        <div>
                            <p style="width: 50px;">'.$row["likes"].'<input style="float:center; width: 25px;", type="image", onclick="disappear()", name="like", src="like.png"></p>
                            <input type="hidden", name="post_number", value="'.$row["post_num"].'"> 
                        </div>
                    </form>';
                    $loops++;
                    }
                echo '
                <form class="post" action="main.php" method="POST">
                    <input type="text" name="post" placeholder="Enter Post Here">
                    <input type="submit" name="submit" value="Submit" />
                </form>';

            ?>
        </div>
    
    </body>
    <script>
        function disappear(){
            documnet.getElementById("like_btn").style.display = 'none';
        }
    </script>
</html>