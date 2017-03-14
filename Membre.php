<?php

    session_start();
    include('ConnectDB.php');
    
?>

<html><?xml version="1.0" encoding="UTF-8"?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <head>
        <meta http-equiv="Content-type" content="charset=utf-8"/>
    </head>
    <body>
        <?php
            if ($_SESSION['Email']) 
            {
                echo "Bienvenue utilisateur : ".$_SESSION['Email']." </br><a href='Deco.php'> Déconnection</a></br>";
                //include ('MDP.php');
            }else header('location:Connexion.php');
        ?>
    </body>
</html>