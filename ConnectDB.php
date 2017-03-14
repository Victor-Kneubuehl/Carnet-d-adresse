<?php
	$PARAM_hote='localhost';
	$PARAM_port='3306';
	$PARAM_nom_bd='adresse';
	$PARAM_utilisateur='root';
	$PARAM_mot_passe='';
	$PARAM_options=array(
		PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
	);
	
	try{
		$connexion = 
			new PDO('mysql:host='. $PARAM_hote .
			';dbname='. $PARAM_nom_bd .
			';port='. $PARAM_port,
		$PARAM_utilisateur,
		$PARAM_mot_passe,
		$PARAM_options);
	} catch (Exception $e) {
		echo 'Erreur : '.$e->getMessage(), '<br/> N° : ', $e->getCode();
		die();
	}
?>