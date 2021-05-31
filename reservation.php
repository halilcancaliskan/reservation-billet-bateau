<?php
include 'start.php';
start();
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <title>Réservation MarieTeam</title>
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
      <div class="slider-item" style="background-image: url('images/thaiti.jpg');">
        <div class="overlay"></div>
        <div class="container">
          <div class="row slider-text align-items-center">
            <div class="col-md-7 col-sm-12 ftco-animate">
              <h1 class="mb-3">Espace réservation</h1>
            </div>
          </div>
        </div>
      </div>

      <div class="slider-item" style="background-image: url('images/tobago.jpg');">
        <div class="overlay"></div>
        <div class="container">
          <div class="row slider-text align-items-center">
            <div class="col-md-7 col-sm-12 ftco-animate">
              <h1 class="mb-3">Espace réservation</h1>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- END slider ------------------------------------------------------------------------------------------------------------------>

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
											echo'<form action="reservation.php?destination#tab" method="post" class="d-block d-lg-flex">';
												echo'<div class="fields d-block d-lg-flex">';
											// affichage select

                      $getNomDepart = $db->prepare("SELECT DISTINCTROW P.nomPort FROM ports P,Liaison L,secteur S WHERE P.codePort=L.codePort AND L.NomSecteur = S.NomSecteur AND idSecteur= ".$row['idSecteur']." ORDER BY `L`.`codePort_Ports` ASC");
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
					echo'</section>';
?>

        <?php
        	echo'<section name="reserv" id="reserv" class="ftco-section">';
        	

          if(isset($_GET['destination']))
           {

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


              

          
          ?>
      <form action="reservation.php?reserver#idTab" method="post">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="row">
				
					
					<table id="tab" class="table" style="margin-top: 8%;">
						  <thead class="thead-dark">
							<tr>
							  <th scope="col">Numéro</th>
							  <th scope="col">Heure</th>
                			  <th scope="col" style="min-width: 115px;">Date</th>
                			  <th scope="col">Bateau</th>
                			  <th scope="col">Passager restante</th>
                			  <th scope="col">Vehicule INF2M restante</th>
                			  <th scope="col">Vehicule SUP2M restante</th>	  
							  <th scope="col">Choix</th>
							</tr>
						  </thead>
						  <tbody>

						  	<?php

						  	$getTableau = $db->prepare("SELECT * FROM traversee WHERE  codeLiaison = ?");
             				$getTableau->execute([$Liaison]);

             				$getT = $db->prepare("SELECT * FROM traversee WHERE codeLiaison = ? AND ");
             				$getT->execute([$Liaison]);
             				$test=$getT->fetch();
             				
             				if($Liaison == Null){echo'<h1 style="color:#FF0000;">AUCUNE LIAISON DISPONIBLE</h1>';}
						  	//

						  	while($info=$getTableau->fetch())
						  	{

  					    echo'<tr>';
    							echo'<th scope="row">'.$info['numeroIdentifiant'].'</th>';		  
    							echo'<td>'.$info['heureDeDepart'].'</td>';		  
    							echo'<td>'.$info['date'].'</td>';		  
    		          echo'<td>'.$info['NomBateau'].'</td>';	
    		          echo'<td>'.$info['PassagerRestant'].'</td>';
    		          echo'<td>'.$info['VehInf2mRestant'].'</td>';
    		          echo'<td>'.$info['VehSup2mRestant'].'</td>';
    							echo'<td><div class="radio"><label><input type="radio" value="'.$info['numeroIdentifiant'].'" name="optradio" id="optradio" checked></label></div></td>';		  
  						  echo'</tr>';	

						  	}



						  	?>
	
						  </tbody>
						
					</table>
			  </div>
          </div>
			
          <!-- END -->

          <div class="col-lg-4 sidebar">
            <div class="sidebar-box ftco-animate">
              <div class="search-tours bg-light p-4">
              	<div name="option">
	                <h3>Choisir les options du voyage</h3>
	                
	                <div class="fields">
	                    <div class="row flex-column">
	                    <form action="" method="post">
							
                    <div class="textfield-search col-sm-12 group mb-3"><input type="text" name="nbAdulte" id="nbAdulte" class="form-control" placeholder="Nombre d'adultes"></div>
                      
                    <div class="textfield-search col-sm-12 group mb-3"><input type="text" name="nbJunior" id="nbJunior" class="form-control" placeholder="Nombre de juniors"></div>
                      
                    <div class="textfield-search col-sm-12 group mb-3"><input type="text" name="nbEnfant" id="nbEnfant" class="form-control" placeholder="Nombre d'enfants"></div>
                      
                    <div class="textfield-search col-sm-12 group mb-3"><input type="text" name="vhInf4" id="vhInf4" class="form-control" placeholder="Voitures inferieure à 2 m"></div>

           				 <div class="textfield-search col-sm-12 group mb-3"><input type="text" name="vhInf5" id="vhInf5" class="form-control" placeholder="Voitures supérieur à 2 m"></div>

           				 <div class="textfield-search col-sm-12 group mb-3"><input type="text" name="fourgon" id="fourgon" class="form-control" placeholder="Nombre de fourgons"></div>

           				 <div class="textfield-search col-sm-12 group mb-3"><input type="text" name="campingcar" id="campingcar" class="form-control" placeholder="Nombre de campingcars"></div>

            			<div class="textfield-search col-sm-12 group mb-3"><input type="text" name="camion" id="camion" class="form-control" placeholder="Nombre de camions"></div>

							
	                      <div class="col-sm-12 group mb-3">
	                        <button input type="submit" align="center" style="margin-left: 25%;margin-top: 5%;padding: 3%;"class="btn btn-success">Réserver</button>
	                      </div>
                      </form>
	                  </div>
	                </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    	</div>
    </form>
  </section>





          <?php
          }

          if(isset($_GET['reserver']))
           {
             $radio= $_POST['optradio'];
             $enfant = 0;
             $adulte = 0;
             $junior = 0;
             $vhInf4 = 0;
             $vhInf5 = 0;
             $fourgon = 0;
             $campingcar = 0;
             $camion = 0;
             $voiture = 0;


             if($_POST['nbEnfant']!=null){$enfant = $_POST['nbEnfant'];}
             if($_POST['nbJunior']!=null){$junior = $_POST['nbJunior'];}
             if($_POST['nbAdulte']!=null){$adulte = $_POST['nbAdulte'];}

             if($_POST['vhInf4']!=null){$vhInf4 = $_POST['vhInf4'];}
             if($_POST['vhInf5']!=null){$vhInf5 = $_POST['vhInf5'];}
             if($_POST['fourgon']!=null){$fourgon = $_POST['fourgon'];}
             if($_POST['campingcar']!=null){$campingcar = $_POST['campingcar'];}
             if($_POST['camion']!=null){$camion = $_POST['camion'];}

             if($vhInf4 !=0 || $vhInf5!=0 || $fourgon !=0 || $camion !=0)
             {
                $voiture = $vhInf4+$vhInf5+$fourgon+$campingcar+$camion;
             }
            

            $getL = $db->prepare("SELECT P.idLiaison FROM traversee T, Periode P,Liaison L WHERE T.idPeriode = P.idPeriode AND T.numeroIdentifiant=?");
            $getL->execute([$radio]);
            $rowLi = $getL->fetch();
            $Liaison = $rowLi['idLiaison'];


            $getTarif = $db->prepare('SELECT P.prixAdulte, P.prixJunior, P.prixEnfants, P.prixVinf4m, P.prixVinf5m, P.prixFourgon, P.prixCamping, P.prixCamion FROM traversee T, Periode P,Liaison L WHERE T.idPeriode = P.idPeriode AND T.numeroIdentifiant=? AND idLiaison = ? AND Date(Now()) BETWEEN P.dateDebut AND P.dateFin');
            $getTarif->execute([$radio,$Liaison]);
            $rowT = $getTarif->fetch();

            $getDateTraversee = $db->prepare("SELECT date FROM traversee WHERE numeroIdentifiant=?");
            $getDateTraversee->execute([$radio]);
            $rowDateT = $getDateTraversee->fetch();
            $dateTraversee = $rowDateT['date'];



            $tarifAdulte = $rowT['prixAdulte'] * $adulte;

            $tarifJunior = $rowT['prixJunior'] * $junior;

            $tarifEnfant = $rowT['prixEnfants'] * $enfant;

            $tarifVoiture = ($rowT['prixVinf4m'] * $vhInf4) + ($rowT['prixVinf5m'] * $vhInf5) + ($rowT['prixFourgon'] * $fourgon) + ($rowT['prixCamping'] * $campingcar) + ($rowT['prixCamion'] * $camion);

            $nbSup2M =  $vhInf5 +  $fourgon + $campingcar + $camion;

            $tarifTotal= $tarifAdulte+$tarifJunior+$tarifEnfant+$tarifVoiture;


          ?>
            <div class="d-flex flex-column p-5" id="idTab" >
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                  <span class="text-muted">Verification de la reservation</span>
                  <!-- <span class="badge badge-secondary badge-pill">3</span> -->
                </h4>
                <ul class="list-group mb-3">
                  <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                      <h6 class="my-0" style="color:red;">Numéro de traversée</h6>
                    </div>

                <?php echo'<span class="text-muted" id="numero" name="numero">'.$radio.'</span>'; ?>

                  </li>
                  <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                      <h6 class="my-0">Adultes</h6>
                      <small class="text-muted">Total prix pour adultes</small>
                 <?php echo'<span class="badge badge-secondary badge-pill">'.$adulte.'</span> '?>
                    </div>

                <?php echo'<span class="text-muted">'.$tarifAdulte.'€</span>' ?>

                  </li>

                  <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                      <h6 class="my-0">Juniors</h6>
                      <small class="text-muted">Total prix juniors</small>
                      <?php echo'<span class="badge badge-secondary badge-pill">'.$junior.'</span> '?>
                    </div>

                    <?php echo'<span class="text-muted">'.$tarifJunior.'€</span>' ?>

                  </li>

                  <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                      <h6 class="my-0">Enfants</h6>
                      <small class="text-muted">Total prix enfants</small>
                      <?php echo'<span class="badge badge-secondary badge-pill">'.$enfant.'</span> '?>
                    </div>

                    <?php echo'<span class="text-muted">'.$tarifEnfant.'€</span>' ?>

                  </li>


                  <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                      <h6 class="my-0">Véhicules</h6>
                      <small class="text-muted">Total prix véhicules</small>
                      <?php echo'<span class="badge badge-secondary badge-pill">'.$voiture.'</span> '?>
                    </div>
                    <?php echo'<span class="text-muted">'.$tarifVoiture.'€</span>' ?>
                  </li>

                  <?php

                  $idClient=$_SESSION['idClient'];

                  $getPoint = $db ->prepare('SELECT NbAchatsFidelisant FROM Client where idClient = ?');
                  $getPoint ->execute([$idClient]);
                  $rowPoint = $getPoint->fetch();
                 $point = $rowPoint['NbAchatsFidelisant'];
                 $prixAPayer = $tarifTotal;

           		  if ($point >= 100)
           		  {
                   
           		  	$reduc = $tarifTotal * 0.25;
	           		echo'<li class="list-group-item d-flex justify-content-between bg-light">';
				            echo'<div class="text-success">';
					            echo'<h6 class="my-0">Promotion</h6>';
					            echo'<small>AVANTAGE CLIENT</small>';
				            echo'</div>';
		                echo'<span class="text-success">-'.$reduc.'€</span>';
	                echo'</li>';
	                $tarifTotal = $tarifTotal - $reduc;      
           		  }

           		  $getDateResa = $db->query("SELECT date FROM traversee WHERE numeroIdentifiant = ".$radio."");
                  $row = $getDateResa->fetch(); 
                  $dateResa = $row['date'];
                  ?>

                  

                  <li class="list-group-item d-flex justify-content-between">
                    <span>Total (EUR)</span>
                    <?php echo'<h3>'.$tarifTotal.'€</h3>' ?>
                  </li>
                </ul>
                <form class="col-sm-12 group mb-3" align="right">
                        <button type="button" onclick="myFunction()" class="btn btn-success">Valider la réservation</button>
                        <p id="demo"></p>
                        <script type='text/javascript'>
                            function myFunction() {
  									document.getElementById("demo").innerHTML = 
  									'<?php 
						            date_default_timezone_set('Europe/Paris');
						            $MontantARegler=$prixAPayer;
						            $dateReservation=date("Y-m-d");
						            $heure=date("H:i");
						            $PlacesA1 = $adulte;
						            $PlacesA2 = $junior;
						            $PlacesA3 = $enfant;
						            $PlacesB1 = $vhInf4;
						            $PlacesB2 = $vhInf5;
						            $PlacesC1 = $fourgon;
						            $PlacesC2 = $campingcar;
						            $PlacesC3 = $camion;
                        $NumeroIdentifiant=$radio;
						            $idClient=$_SESSION['idClient'];

						             $totalPassager = $PlacesA1+$PlacesA2+$PlacesA3;

						             $sql=$db->prepare("INSERT INTO Reservation (MontantARegler,date,dateTraversee,Heure,numeroIdentifiant,idClient,PlacesA1,PlacesA2,PlacesA3,PlacesB1,PlacesB2,PlacesC1,PlacesC2,PlacesC3) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
						             $sql->execute([$MontantARegler, $dateReservation,$dateTraversee,$heure, $NumeroIdentifiant, $idClient,$PlacesA1,$PlacesA2,$PlacesA3,$PlacesB1,$PlacesB2,$PlacesC1,$PlacesC2,$PlacesC3]);
			
                        $update=$db->query('UPDATE traversee SET PassagerRestant=PassagerRestant-'.$totalPassager.',VehInf2mRestant=VehInf2mRestant-'.$vhInf4.',VehSup2mRestant=VehSup2mRestant-'.$nbSup2M.' WHERE numeroIdentifiant='.$radio.'');

                        
						            echo'<h3 style="color:red;">Enregistrement reussi</h3>';

						            echo'<a class="txt1 bo1 hov1" href="accueil.php">Revenir au menu</a>';



  									 ?>'
									
									
							}
            </script>
          </form>
        </div>
      </div>
<?php
           
		}

		?>

            </div>
          </div>
        </div>
      </div>
    </div>

    <!--------------------------------------------------------------------------------------------------------- 
    	--->

      <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">

                                
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Rapport de mer</strong>
                                    </div>
                                        <div class="table-responsive m-b-40">
                                        <table class="table table-borderless table-data3">
                                            <thead>
                                                <center>
                                                <tr>
                                                    <th>Rapport</th>
                          <th>Nom du capitaine</th>
                                                    <th>Etat de la mer</th>
                                                    <th>Commentaire</th>
                                                    <th>Duree du retard</th>

                                                    <th style="max-width: 2px !important;"></th>
                                                    <th></th>

                            
                                                 </tr>
                                                  </center>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $result=$db->query('SELECT * FROM rapport');
                                            $i = 0;
                                            while($row=$result->fetch())
                                            {
                                            $i++;


                                            echo'<form id="ligne'.$i.'" action="modifRapport.php?modif" method="post" class="form-horizontal">
                                                <tr>

                                                    <td>
                                                    <label>'.$row['idRapport'].'</label>
                                                    </td>

                                                    <td>
                                                    '.$row['NomCapitaine'].'
                                                    </td>

                                                    <td>
                                                    '.$row['EtatMer'].'
                                                    </td>
                                                    <td>
                                                    '.$row['commentaire'].'
                                                    </td>

                                                    <td>
                                                    '.$row['duree_du_retard'].'
                                                    </td>


                                                </tr></form>';
                                            }                                     
                                            ?>
                                            </tbody>
                                        </table>
                                        
                                    </div>             
                               </div>
                            </div>
                        </div>

      





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