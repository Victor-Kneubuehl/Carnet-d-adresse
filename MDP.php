<?php

	include('ConnectDB.php');
	if(isset($_POST["Submit"]))
	{
		$password="";
		$new_pass=htmlentities(trim($_POST['new_pass']));
		$new_pass_conf=htmlentities(trim($_POST['new_pass_conf']));
		$pass_old=htmlentities(trim($_POST['pass_old']));
		// tu récupère l'ancien mot de passe dans la bdd
		$rq = "SELECT pwd FROM users WHERE email = '".$_SESSION['mail']."' ";
		//echo $rq;
		$sql = mysqli_query($connect, $rq); 

		//Faut que je récupere l'id dans ma base pour savoir quel utilisateur veut changer de mdp mais comment récup l'id ??
		list($password) = mysqli_fetch_array($sql);
		// tu compare si le nouveau passe correspond à l'ancien
		if ($new_pass == $new_pass_conf)
		{
		    // tu encrypte l'ancien mot de passe du formulaire pour le comparer à celui de ta bdd
		    $pass_old = md5($pass_old);
		    //tu vérifie si il sont identique
		    if ($password == $pass_old)
		    {
		        //si oui tu update et encrypte le nouveau mot de passe dans la bdd
		        $pass = md5($new_pass);  
		        $query = mysqli_query($connect, "UPDATE users SET pwd = '$pass' WHERE email  = '".$_SESSION['mail']."' ");
		        echo "mot de passe changé";
		    }
		    else
		    {
		        echo "Ancien mot de passe non valide";
		    }
		}
		else
		{
		    echo "Mot de passe de confirmation incorrecte";
		}
	}

?>

<form method="post" action="Membre.php">
<p>Nouveau mot de passe : </p>
<input type="password" name="new_pass">
<p>Confirmation : </p>
<input type="password" name="new_pass_conf">
<p>Ancien mot de passe :</p> 
<input type="password" name="pass_old"> </br></br>
<input type="submit" name="Submit" value="Valider">