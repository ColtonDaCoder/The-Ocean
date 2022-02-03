
<?php
    session_start();
    require_once('config.php');
    if(!isset($_SESSION['admin'])){
        $_SESSION['admin'] = "false";
    }
?>

<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta name="language" content="English">
        <title>The Ocean | Admin</title>
        <link rel="stylesheet" href="style.css">
        <link rel="icon" href="pics/favicon.ico"/>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
    </head>
    <body onload="onload()" style="background-color: whitesmoke;">
        <br><br><br><br><br><br>
        <div>
            <?php
                if($_SESSION['admin'] == "true"){
                    $result = mysqli_query($link, "SELECT post_num, _text, likes FROM posts ORDER BY likes DESC");
                    while (($row = mysqli_fetch_array($result))) { 
                        echo '<p>'.$row["_text"].'</p>';
                        echo '
                        <form action="admin_post.php" method="POST" style="width:50px;" >
                            <div>
                                <p style="width: 50px;">'.$row["likes"].'<input style="float:center; width: 25px;", type="image", name="like", src="delete.png"></p>
                                <input type="hidden", name="delete_post", value="'.$row["post_num"].'"> 
                            </div>
                        </form>';
                    }
                }else{
                    echo '
                    <form class="post" action="admin_post.php" method="POST">
                        <input type="password" name="password" placeholder="Admin Password">
                        <input type="submit" name="submit" value="Submit" />
                    </form>';
                }
            ?>
        </div>
    
    </body>
    <script>

    </script>
</html>