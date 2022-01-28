<?php
    session_start();
    require_once("config.php");
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    if($_SESSION["loggedin"] == true){
        $_SESSION["wedges"] = $link->query("SELECT wedges FROM users WHERE id = " .$_SESSION["id"])->fetch_object()->wedges;
    }else{
        header("location: wallet.php");
        exit;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    }
?>

<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta name="language" content="English">
        <title>The Incline | Main</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" href="pics/favicon.ico"/>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
    </head>
    <body onload="onload()" style="background-color: whitesmoke;">
        <br><br><br><br><br><br>
        <div>
            <?php
                $loops = 0;
                $result = mysqli_query($link, "SELECT post_name, likes, visible FROM posts ORDER BY likes DESC");
                while (($row = mysqli_fetch_array($result)) && ($loops <= 10)) { 
                    if ($row['visible'] == 1) {
                        $id = explode("-" , $row['post_name']);
                        echo '<image style="width:80%;" class="post" src="files/'.$row['post_name'].'"></image>';
                        echo '
                        <form action="like.php" method="POST" style="width:50px;" target="votar">
                            <input type="integer" style="display:none;" name="id" value="'.$id[1].'" />
                            <input type="image" name="submit" src="pics/like.png" border="0" alt="Submit" style="width: 50px;" />
                        </form>';
                        $loops++;
                    }
                } 
            ?>
        </div>

        <a id="darkModeBtn" class="dmButton" href="#" onclick="darkMode()" onmouseover="hover()" onmouseout="nothover()"> <image id="moonpic" src="pics/moon.png"></image></a>
        <a id="darkModeBtn" class="dmButton" href="index.php" onmouseover="hoverH()" onmouseout="nothoverH()" style="height: 15px; width: 15px;  bottom: 11%;"> <image id="housePic" src="pics/house.png"></image></a>
        <iframe name="votar" style="display:none;"></iframe>
    
        <?php
            if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
                echo '<a id="logInBtn" class="btn" href="login.php">Login / Register</a>';
            } else{
                echo '<a id="logInBtn" class="btn" href="login.php">Wallet</a>';
                echo '<a id="counter" class="btn btn-warning">Wedges: ';
                echo htmlspecialchars($_SESSION["wedges"]);
                echo '</a>';
            }
        ?>
    </body>
    <script>
 
        if(window.innerWidth < 960){
            window.location = "indexP.php";
        }
        function onload() {
            if(getCookie("darkMode") == "true"){
                document.body.style.backgroundColor = "black";
            }
        }

        function getCookie(name) {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);
            if (parts.length === 2) return parts.pop().split(';').shift();
        }

        function uplift(){
            alert(72);
        }

        function hover(){
            document.getElementById("moonpic").src="pics/yellowmoon.png"
        }

        function nothover(){
            document.getElementById("moonpic").src="pics/moon.png"
        }

        function hoverH(){
            document.getElementById("housePic").src="pics/house-yello.png"
        }

        function nothoverH() {
            document.getElementById("housePic").src="pics/house.png"
        }

        function darkMode() {
            if(document.body.style.backgroundColor == "whitesmoke"){
                document.body.style.backgroundColor = "black"
                document.cookie = "darkMode=true";
            } else{
                document.body.style.backgroundColor = "whitesmoke";
                document.cookie = "darkMode=false";
            }
        }

        $('#submit').click(function() {
        $.ajax({
            url: 'send_email.php',
            type: 'POST',
            data: {
                email: 'email@example.com',
                message: 'hello world!'
            },
            success: function(msg) {
                alert('Email Sent');
            }               
        });
    });
    </script>
</html>