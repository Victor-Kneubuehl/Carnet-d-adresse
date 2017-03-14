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
        ?>
        <form method="get" action="<?php echo $_SERVER['PHP_SELF'];?>">
            <p>Chercher un utilisateur ? (nom, prénom, adresse e-mail, numéro de téléphone) : </p>
            <input type="text" name="v_saisie"/>
            <p>
                <button type="submit">Chercher</button>
            </p>
        </form>
        <?php   
                $valeurSaisie = '';
                if (isset($_GET['v_saisie'])) {
                    $valeurSaisie = $_GET['v_saisie'];

                    if($valeurSaisie != ''){
                        $rechercheSQL = 'SELECT * FROM utilisateur
                                  WHERE Nom LIKE :param1
                                  OR Prenom LIKE :param1
                                  OR Email LIKE :param1
                                  OR NumTel LIKE :param1';
                        $resultatRech=$connexion->prepare($rechercheSQL) or die ('Echeque de la requête : '.$rechercheSQL);
                        $resultatRech->bindValue (':param1', "%$valeurSaisie%");
                        $resultatRech->execute();
                        $resultatRech->SetFetchMode(PDO::FETCH_OBJ);
                        while ($UneRech = $resultatRech->fetch())
                        {
                            //affichage du résultats
                            echo '<table>
                                    <tr>
                                        <td>Nom : '.htmlentities($UneRech->Nom, ENT_QUOTES, "UTF-8").'</td>
                                    </tr>
                                    <tr>
                                        <td>Prenom : '.htmlentities($UneRech->Prenom, ENT_QUOTES, "UTF-8").'</td>
                                    </tr>
                                    <tr>
                                        <td>E-mail : '.htmlentities($UneRech->Email, ENT_QUOTES, "UTF-8").'</td>
                                    </tr>
                                    <tr>
                                        <td>Numéro de téléphone : '.htmlentities($UneRech->NumTel, ENT_QUOTES, "UTF-8").'</td>
                                    </tr>
                                </table></br></br>';
                        }
                    }
                }
            }else header('location:Connexion.php');
        ?>
    </body>
</html>