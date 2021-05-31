<!DOCTYPE html>


<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Marie Team - Liste Client</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/stylesDashboard.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
</head>
<body>
	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span></button>
				<a class="navbar-brand" href="#">Marie Team</a>
			</div>
		</div>
	</nav>
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div class="profile-sidebar">
			<div class="profile-userpic">
				<img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">
			</div>
			<div class="profile-usertitle">
				<div class="profile-usertitle-name">Username</div>
				<div class="profile-usertitle-status"><span class="indicator label-success"></span>En ligne</div>
			</div>
			<div class="clear"></div>
		</div>
		<ul class="nav menu">
			<li><a href="index.html"><em class="fa fa-dashboard">&nbsp;</em>Panneau de configuration</a></li>
			<br/>
			<li class="active"><a href="listeClient.html"><em class="fa fa-book">&nbsp;</em>Liste client</a></li>
			<li class="parent "><a data-toggle="collapse" href="#sub-item-1">
				<em class="fa fa-navicon">&nbsp;</em>Pages<span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span></a>
				<ul class="children collapse" id="sub-item-1">
					<li><a class="" href="#">
						<span class="fa fa-arrow-right">&nbsp;</span> Ajout liaison
					</a></li>

					<li><a class="" href="#">
						<span class="fa fa-arrow-right">&nbsp;</span> Ajout port
					</a></li>

					<li><a class="" href="#">
						<span class="fa fa-arrow-right">&nbsp;</span> Ajout Trajet
					</a></li>
				</ul>
			</li>
			<li><a href="login.html"><em class="fa fa-power-off">&nbsp;</em> Deconnection</a></li>
		</ul>
	</div>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Liste Client</h1>
			</div>
		</div>

			<table class="table" style="margin-top: 8%;">
				<thead class="thead-dark">
					<tr>
						<th scope="col">idClient</th>
						<th scope="col">NomClient</th>
                		<th scope="col">PrenomClient</th>
						<th scope="col">CodePostal</th>
						<th scope="col">Ville</th>
						<th scope="col">Adresse</th>
						<th scope="col">Mail</th>
						<th scope="col">NbAchatsFidelisant</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$db=new PDO('mysql:host=localhost; dbname=MariaTeam','root','root');
						$getTableau = $db->prepare("SELECT * FROM client");
						$getTableau->setFetchMode(PDO:: FETCH_ASSOC);
						$getTableau->execute();
						while ($info=$getTableau->fetch()) {
						    echo'<tr>';
								echo'<th scope="row">'.$info['idClient'].'</th>';		  
								echo'<td>'.$info['NomClient'].'</td>';		  
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

<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	
</body>
</html>
