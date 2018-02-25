<?php
include_once '../controller/controller.php';
$ctrlLog = new Controller();
$ctrlLog->connection();


$GLOBALS['language'] = 'English';
$lang =	$_SESSION['language'];
$GLOBALS['language'] = $lang;


?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Community</title>

    <!-- Bootstrap core CSS -->
    <link href="../bootstrapJs/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

    <!--- Style Sheet -->
	<link rel="Stylesheet" href="../css/Style.css">
	 <link rel="Stylesheet" href="../css/Style_<?=$_SESSION['configuration']?>.css">

  </head>

  <body>
<div class="tagline-upper text-center text-heading text-shadow text-white mt-5 d-none d-lg-block"><?php echo localize('Community Rating');?></div>
    <div class="tagline-lower text-center text-expanded text-shadow  text-white mb-5 d-none d-lg-block">Baghchal | Hindi Learning</div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-faded py-lg-4">
      <div class="container">
        <a class="navbar-brand text-uppercase text-expanded font-weight-bold d-lg-none" href="index.php"><?php echo localize('Community Rating');?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav mx-auto">
            <li class="nav-item active px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="userreview.php"><?php echo localize('User Rating');?></a>
            </li>
            <li class="nav-item px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="logout.php"><?php echo localize('Sign Out');?></a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container">

      
      <div class="bg-faded p-4 my-4">
        <hr class="divider">
        <h2 class="text-center text-lg text-uppercase my-0">
          <strong><?php echo localize('All Tables');?></strong>
        </h2>
        <hr class="divider">
		
		
			
		<div class="container">		
	
          
			<?php
			echo "<h2>"."<strong>".localize('Star Table')."</strong>"."</h2>";
			$startab = new TablesExt($db);
			$result =$startab->getStar($db);
			$startab->displayStar($result);
			
			echo "<h2>"."<strong>".localize('Login Table')."</strong>"."</h2>";
			$logintab = new Tables($db);
			$result =$logintab->getLogin($db);
			$logintab->displayLogin($result);		

			echo "<h2>"."<strong>".localize('Registration Table')."</strong>"."</h2>";
			$regTab = new TablesExt($db);
			$result =$regTab->getRegistration($db);
			$regTab->displayRegistration($result);
			
			echo "<h2>"."<strong>".localize('User Rating Table')."</strong>"."</h2>";
			$userTab = new TablesExt($db);
			$result =$userTab->getUserRating($db);
			$userTab->displayUserRating($result);
			?>
			
			
		</div>	


 
 
 
 
 
 
 
    <!-- /.container -->

    <footer class="bg-faded text-center py-3">
      <div class="container">
        <p class="m-0">Copyright &copy; Sbs0074</p>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="../bootstrapJs/jquery/jquery.min.js"></script>
    <script src="../bootstrapJs/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
