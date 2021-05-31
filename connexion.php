<?php
			require 'connect.php';

			$username=$_POST['username'];
			$pass=$_POST['password'];

			//Vérification du MDP

			$req = $db->prepare("SELECT mdp,idClient FROM Client WHERE idClient = ?");
			$req->execute([$username]);

			$password = $req->fetch();

			//Vérification de l'identifiant

			$reqName = $db->prepare("SELECT idClient FROM Client WHERE idClient = ?");
			$reqName->execute([$username]);

			$Name = $reqName->fetch();



			if($Name == Null)
			{
				 	echo "<script type='text/javascript'>";
					echo "alert('identifiant non enregistré');";
					echo "window.location.href='index.html';";
					echo "</script>";
			} 

			else if ($pass == $password['mdp']) {
			        session_start();

			        $_SESSION['idClient'] = $password['idClient'];
			        $_SESSION['mdp'] = $password['mdp'];

			        
					header('Location: accueil.php');
			        
			    }
			    else {
			    	echo "<script type='text/javascript'>";
					echo "alert('Mauvais identifiant ou mot de passe !');";
					echo "window.location.href='index.html';";
					echo "</script>";
		}

?>