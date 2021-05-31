<?php 
	$db=new PDO('mysql:host=localhost; dbname=mariaTeam','root','');
	   
		$PrenomClient=$_POST['firstname'];
		$NomClient=$_POST['lastname'];
		$IdClient=$_POST['username'];
		$Adresse=$_POST['adress'];
		$Ville=$_POST['city'];
		$CodePostal=$_POST['postalcode'];
		$Mail=$_POST['email'];
		$mdp=$_POST['password'];


		$reqMail = $db->prepare("SELECT Mail FROM Client WHERE Mail = ?");
			$reqMail->execute([$Mail]);

			$ValiderMail = $reqMail->fetch();

		$reqName = $db->prepare("SELECT idClient FROM Client WHERE idClient = ?");
			$reqName->execute([$IdClient]);

			$Name = $reqName->fetch();

		if($ValiderMail == Null && $Name == Null )
		{
			$sql=$db->prepare("INSERT INTO Client (idClient, NomClient, PrenomClient, CodePostal, Ville, Adresse, Mail, NbAchatsFidelisant, mdp ,Role) VALUES(?,?,?,?,?,?,?,?,?,'user')");
			$sql->execute([$IdClient, $NomClient, $PrenomClient, $CodePostal, $Ville, $Adresse, $Mail, 0, $mdp]);

			echo "<script type='text/javascript'>";
			echo "alert('Vous avez bien été enregistré');";
			echo "window.location.href='index.html';";
			echo "</script>";
		}
		else
		{
			echo "<script type='text/javascript'>";
			echo "alert('Compte déjà existant');";
			echo "window.location.href='rregister.html';";
			echo "</script>"; 

		}

		
	
?>