<?php
include 'start.php';
start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Tarification</title>
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
              <h1 class="mb-3">Prix</h1>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- END slider -->
    <section name="nav">
    <div class="ftco-section-search">
      <div class="container">
        <div class="row">
          <div class="col-md-12 tabulation-search">
            <div class="element-animate">
              <div class="nav nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <?php

              $getSecteur = $db->prepare("SELECT * FROM `secteur` ORDER BY `secteur`.`idSecteur` ASC");
              $getSecteur->setFetchMode(PDO:: FETCH_ASSOC);
              $getSecteur->execute();
              $i = 1;

              while($row=$getSecteur->fetch())
              {
                if($i==1)
                {
                  echo'<a class="nav-link p-3 active" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1" role="tab" aria-controls="v-pills-1" aria-selected="true">';
                }
                else{
                  echo'<a class="nav-link p-3" id="v-pills-'.$row['idSecteur'].'-tab" data-toggle="pill" href="#v-pills-'.$row['idSecteur'].'" role="tab" aria-controls="v-pills-'.$row['idSecteur'].'" aria-selected="false">';
                }
                echo' <span>'.$row['idSecteur'].' - </span>'.$row['NomSecteur'].'</a> ';
                $i++;        
              }
            
            ?>
              </div>
            </div>

            <div class="tab-content py-5" id="v-pills-tabContent">

              <!--  -->

            <?php

              $getSecteur = $db->prepare("SELECT * FROM `secteur` ORDER BY `secteur`.`idSecteur` ASC");
              $getSecteur->setFetchMode(PDO:: FETCH_ASSOC);
              $getSecteur->execute();
  



          for($i=0 ; $i<=$row=$getSecteur->fetch() ; $i++ )

          {
                  if($i == 0)
                  {
                    echo'<div class="tab-pane fade active show" id="v-pills-'.$row['idSecteur'].'" role="tabpanel" aria-labelledby="v-pills-'.$row['idSecteur'].'-tab">';
                  }
                  else
                  {
                    echo'<div class="tab-pane fade" id="v-pills-'.$row['idSecteur'].'" role="tabpanel" aria-labelledby="v-pills-'.$row['idSecteur'].'-tab">';
                  }
                  $i++;
                    echo'<div class="block-17">';
                      echo'<form action="prix.php?prix#tab" method="post" class="d-block d-lg-flex">';
                        echo'<div class="fields d-block d-lg-flex">';
                      
                      // affichage select

                            $getNomDepart = $db->prepare("SELECT DISTINCTROW P.nomPort FROM Ports P,Liaison L,secteur S WHERE P.codePort=L.codePort AND L.NomSecteur = S.NomSecteur AND idSecteur= ".$row['idSecteur']." ORDER BY `L`.`codePort_Ports` ASC");
                            $getNomDepart->setFetchMode(PDO:: FETCH_ASSOC);
                            $getNomDepart->execute();

                            $getNomArrivee = $db->prepare("SELECT DISTINCTROW P.nomPort FROM Ports P,Liaison L,secteur S WHERE P.codePort=L.codePort_Ports AND L.NomSecteur = S.NomSecteur AND idSecteur= ".$row['idSecteur']." ORDER BY `L`.`codePort_Ports` ASC");
                            $getNomArrivee->setFetchMode(PDO:: FETCH_ASSOC);
                            $getNomArrivee->execute();


                      
                            echo'<div class="select-wrap one-third">';
                              echo'<div class="icon"><span class="ion-ios-arrow-down"></span></div>';
                                echo'<select name="depart" id="depart" class="form-control">';
                                echo'<option disabled selected>Ville de depart</option>';

                                while($rowD=$getNomDepart->fetch() )
                                {

                                  echo'<option value="'.$rowD['nomPort'].'" style="color:#000;">'.$rowD['nomPort'].'</option>';

                                }
                                echo'</select>';
                            echo'</div>';


                            echo'<div class="select-wrap one-third">';
                              echo'<div class="icon"><span class="ion-ios-arrow-down"></span></div>';
                                echo'<select name="arrivee" id="arrivee" class="form-control">';
                                echo"<option disabled selected>Saisissez une destination</option>";
                                  while($rowA=$getNomArrivee->fetch() )
                                {

                                  echo'<option value="'.$rowA['nomPort'].'" style="color:#000;">'.$rowA['nomPort'].'</option>';

                                }
                                echo'</select>';
                            echo'</div>'; 

                        /////// 
                        echo'</div>';
                      echo'<input type="submit" class="search-submit btn btn-primary" value="Trouver">';
                      echo'</form>';
                    echo'</div>';
                  echo'</div>';
				

           
          }
          ?>
          </section> 

          <?php
          if(isset($_GET['prix'])){
              $depart=$_POST['depart'];

              $arrivee=$_POST['arrivee'];


              $getCodeDepart = $db->prepare('SELECT codePort From Ports where nomPort=? ');
              $getCodeDepart->execute([$depart]);

              $rowD=$getCodeDepart->fetch();



              $getCodeArrivee = $db->prepare('SELECT codePort From Ports where nomPort=? ');
              $getCodeArrivee->execute([$arrivee]);

              $rowA=$getCodeArrivee->fetch();


              $depart2 = $rowD['codePort'];

              $arrivee2 = $rowA['codePort'];



              $getCodeLiaison = $db->prepare("SELECT codeLiaison From Liaison where codePort=? and codePort_Ports=? ");
              $getCodeLiaison->execute([$depart2,$arrivee2]);

              $rowL=$getCodeLiaison->fetch();

              $Liaison = $rowL['codeLiaison'];

              $requete = "SELECT * From Periode WHERE idLiaison ='".$Liaison."'";
              $getPrix = $db->query($requete);


            ?>
            <section>
			    <div class="container">        
				    <table id="tab" class="table" style="margin-top: 8%; margin-bottom: 10%;">
				    <thead class="thead-dark">
					    <tr>
						    <th>Période</th>
                <th>Date Début</th>
                <th>Date Fin</th>
						    <th>Adultes</th>
						    <th>Juniors</th>
						    <th>Enfants</th>
						    <th>Véhicules -4m</th>
						    <th>Véhicules -5m</th>
						    <th>Fourgons</th>
						    <th>Campings</th>
						    <th>Camions</th>
						    </tr>
					    </thead>
				    <tbody>
				    <?php 
				    while($row=$getPrix->fetch())
				    {
				    echo'
				    	<tr>
						    <td>'.ucfirst($row['saison']).'</td>
                <td>'.$row['dateDebut'].'</td>
                <td>'.$row['dateFin'].'</td>
						    <td>'.$row['prixAdulte'].'€</td>
						    <td>'.$row['prixJunior'].'€</td>
						    <td>'.$row['prixEnfants'].'€</td>
						    <td>'.$row['prixVinf4m'].'€</td>
						    <td>'.$row['prixVinf5m'].'€</td>
						    <td>'.$row['prixFourgon'].'€</td>
						    <td>'.$row['prixCamping'].'€</td>
						    <td>'.$row['prixCamion'].'€</td>
						</tr>';
				    }					
					?>
						</tbody>
				    </table>
			  	</div>
		  	</section>

          <?php
}
          ?>





  <!-- loader -->
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