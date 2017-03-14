<?php
    //démarre une session
    session_start();
    //ce co a la BDD
    include('ConnectDB.php');

	if (isset($_POST['submit'])) {
		//récupère les donnée du formulaire (utiliser le htmlentities uniquement pour de l'affichage JAMAIS de l'insertion)
		$nom=trim($_POST['nom']);
        $prenom=trim($_POST['prenom']);
        $mail=trim($_POST['mail']);
		$telephone=trim($_POST['telephone']);
		$password=trim($_POST['password']);
		$repeatpassword=trim($_POST['repeatpassword']);
	    if ($nom && $password && $repeatpassword) {
	       //test que le mot de passe sois bien celui voulu
	       if ($password==$repeatpassword) {
               
                //met le mdp en md5
                $password=md5($password);
               //test si l'adresse email est valide
               if (preg_match('#^(([a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+\.?)*[a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+)@(([a-z0-9-_]+\.?)*[a-z0-9-_]+)\.[a-z]{2,}$#i',$mail)) {
                    //test si le numéro de téléphone est valide 
                    if (preg_match("#(^\+[0-9]{2}|^\+[0-9]{2}\(0\)|^\(\+[0-9]{2}\)\(0\)|^00[0-9]{2}|^0)([0-9]{9}$|[0-9\-\s]{10}$)#", $telephone))
                    {
                        $ADD="SELECT * FROM utilisateur WHERE Email=:param1";
                        $resultat = $connexion->prepare($ADD) or die ('Echèque de la requête : '.$ADD);
                        $resultat->bindValue (':param1', $mail);
                        $resultat->execute();
                   
                        $rows=$resultat->rowCount();
                        //si les données sont correcte renvoi sur la page index
                        if ($rows==0) {
                            //met les données dans la BDD
                            $create_account = $connexion->prepare("INSERT INTO utilisateur SET Nom = ?, Prenom = ?, MDP = ?, Email = ?, NumTel = ?");
                            $create_account->execute([$nom, $prenom, $password, $mail, $telephone]);
                
                            echo 'Ajout terminer :) <a href="Connexion.php">Connexion ici</a></br>';
                        }
                    }else echo "le numéro de téléphone n'est pas valide";
               }else echo "l'adresse email n'est pas valide";
             }else echo "cet utilisateur existe déjà!";
	       }else echo "Les deux mot de passe doivent être identique";
	    }else echo "Veuillez saisir tout les champs";
		
?>
<html><?xml version="1.0" encoding="UTF-8"?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"k
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <head>
        <meta http-equiv="Content-type" content="charset=utf-8"/>
        <title>Nouvel-Utilisateur</title>
    </head>
    <body>
        <!-- Formulaire d'ajout d'utilisateurs -->
        <form method="POST" action="Adduser.php">
            <p>Nom :</p>
            <input type="text" name="nom">
            <p>Prénom :</p>
            <input type="text" name="prenom">
            <p>E-mail :</p>
            <input type="text" name="mail">
            <p>Numéro de téléphone :</p>
            <input type="tel" name="telephone">
            <p>Mot de passe :</p>
            <input type="password" name="password">
            <p>Repetez le mot de passe :</p>
            <input type="password" name="repeatpassword"></br></br>
            <input type="submit" value="Ajouter" name="submit">
        </form>
    </body>
</html>