<?php
    //démarre une session
    session_start();
    //ce co a la BDD
    include('ConnectDB.php');
    //vérifie que le formulaire a été envoyé
    if(isset($_POST['submit'])){
        //met l'addresse mail et le mot de passe dans une variable
        $mail=htmlentities(trim($_POST['mail']));
        $password=htmlentities($_POST['password']);

        //Si l'adresse et le mot de passe ne sont pas vides les mettre dans la BDD
        if ($mail && $password) {
            //crypte le mot de passe en md5
            $password=md5($password);
            //Test dans la BDD si les données entrées sont correcte
            $chSQL="SELECT * FROM utilisateur WHERE Email=:param1 && MDP=:param2 ";
                $resultat = $connexion->prepare($chSQL) or die ('Echèque de la requête : '.$chSQL);
                $resultat->bindValue (':param1', $mail);
                $resultat->bindValue (':param2', $password);
                $resultat->execute();
            
            $rows=$resultat->rowCount();
            //si les données sont correcte renvoi sur la page index
            if ($rows==1) {
                $_SESSION['Email']=$mail;
                header('Location:Membre.php');
                //echo "sa a marcher GG";
            }else echo "Données incorrecte";

        }else echo "Veuilez remplir tout les champs";
    }

?>

<html><?xml version="1.0" encoding="UTF-8"?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	<head>
		<meta http-equiv="Content-type" content="charset=utf-8"/>
		<title>Connexion</title>  
	</head>
    <body>
        <form method="POST" action="Connexion.php">
            <p>E-mail :</p>
            <input type="text" name="mail">
            <p>Mot de passe :</p>
            <input type="password" name="password"> </br></br>
            <input type="submit" value="Valider" name="submit">
        </form>
    </body>
</html>