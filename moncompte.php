<?php
include 'start.php';
start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Mon Compte</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,600,700" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    
    <?php
    include('nav.php');
    ?>
    <!-- END nav -->
    
    <section class="home-slider owl-carousel">
      <div class="slider-item" style="background-image: url('images/bg_1.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
          <div class="row slider-text align-items-center">
            <div class="col-md-7 col-sm-12 ftco-animate">
              <h1 class="mb-3">MonCompte</h1>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- END slider -->

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	    <div class="container">		
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header" style="text-align: center;">Information du compte</h1>
				
				<div class="text">
					<table class="table" style="margin-top: 8%; margin-bottom: 10%;text-align: center;">
						<thead class="thead-dark">
							<tr>
								<th scope="col">Nom</th>
		                		<th scope="col">Prenom</th>
								<th scope="col">Code Postal</th>
								<th scope="col">Ville</th>
								<th scope="col">Adresse</th>
								<th scope="col">Mail</th>
								<th scope="col">Nombre de points</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$getTableau = $db->prepare("SELECT * FROM Client WHERE idClient='".$_SESSION['idClient']."' ");
								$getTableau->setFetchMode(PDO:: FETCH_ASSOC);
								$getTableau->execute();
								while ($info=$getTableau->fetch()) {
								  echo'<tr>';
										echo'<th scope="row">'.$info['NomClient'].'</th>';		  		  
										echo'<td>'.$info['PrenomClient'].'</td>';		  
					          echo'<td>'.$info['CodePostal'].'</td>';
					          echo'<td>'.$info['Ville'].'</td>';
					          echo'<td>'.$info['Adresse'].'</td>';
					          echo'<td>'.$info['Mail'].'</td>';
					          echo'<td>'.$info['NbAchatsFidelisant'].'</td>';		  
									echo'</tr>';	
								}
							?>
						</tbody>			
					</table>
					</div>
				</div>	
				</br>
				<div class="col-lg-12">
					<h1 class="page-header" style="text-align: center;">Réservation effectué</h1>
				
        <table class="table" style="text-align: center;">
						<thead class="thead-dark">
							<tr>
								<th scope="col">Numéro de reservation</th>
		            <th scope="col">Montant payé</th>
								<th scope="col">Date</th>
								<th scope="col">Heure</th>
								<th scope="col">Numéro de traversée</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$getTableau = $db->prepare("SELECT * FROM reservation WHERE idClient='".$_SESSION['idClient']."' ");
								$getTableau->setFetchMode(PDO:: FETCH_ASSOC);
								$getTableau->execute();
								while ($info=$getTableau->fetch()) {
								  echo'<tr>';
										echo'<th scope="row">'.$info['NumReservation'].'</th>';		  		  
										echo'<td>'.$info['MontantARegler'].'€</td>';		  
					          echo'<td>'.$info['date'].'</td>';
					          echo'<td>'.$info['Heure'].'</td>';
					          echo'<td>'.$info['numeroIdentifiant'].'</td>';	  
									echo'</tr>';	
								}
							?>
						</tbody>			
					</table>
					</div>
			</div>
		</div>
	</div>


  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/jquery.timepicker.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>
    
  </body>
</html>