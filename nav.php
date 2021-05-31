<html>
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
      <div class="container">
        <a class="navbar-brand" href="../../index.html">MARIETEAM</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a href="accueil.php" class="nav-link">Accueil</a></li>
            <li class="nav-item"><a href="reservation.php" class="nav-link">Réservation</a></li>
            <li class="nav-item"><a href="prix.php" class="nav-link">Prix</a></li>
            <li class="nav-item"><a href="moncompte.php" class="nav-link">Mon Compte</a></li>
</html>
            <?php         
              $getRole=$db->query("SELECT Role FROM Client WHERE idClient='".$_SESSION['idClient']."'");
			  $row=$getRole->fetch();
			  $role=$row['Role'];

              if($role=="admin")
              {
                echo('<li class="nav-item"><a href="dashboard/index.php" class="nav-link">Panneau de configuration</a></li>');
              }
            ?>   
<html>     
            <li class="nav-item"><a href="deco.php" class="nav-link" style="color: #ff0000; "><span>Se deconnecter</span></a></li>            
          </ul>
        </div>
      </div>
</nav>