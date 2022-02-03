
<?php
    session_start();
    require_once('config.php');
    if(!isset($_SESSION['sort_by'])){
        $_SESSION['sort_by'] = "new";
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
                $result = mysqli_query($link, "SELECT post_num, _text, likes FROM posts ORDER BY likes DESC");
                while (($row = mysqli_fetch_array($result))) { 
                    echo '<p id="post_location'.$row["post_num"].'">'.$row["_text"].'</p>';
                    echo '
                    <form action="post.php" method="POST" style="width:50px;">
                        <div>
                            <p style="width: 50px;">'.$row["likes"].'<input style="float:center; width: 25px;", type="image", name="like", src="like.png"></p>
                            <input type="hidden", name="post_number", value="'.$row["post_num"].'"> 
                        </div>
                    </form>';
                    }
                echo '
                <form class="post" action="post.php" method="POST">
                    <input type="text" name="post" placeholder="Enter Post Here">
                    <input type="submit" name="submit" value="Submit" />
                </form>';

            ?>
        </div>
    </body>
</html>