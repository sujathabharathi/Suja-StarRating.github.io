<?php
include_once '../controller/controller.php';

$ctrlLog = new Controller();
$ctrlLog->connection();

if (isset($GLOBALS['language']))
{
	$GLOBALS['language'] = $_SESSION['language'];
}
else
{
	$GLOBALS['language'] = 'English';
	$_SESSION['language'] = $GLOBALS['language'];
}

if (isset($_POST['submit']))
{
	if (isset($_POST['language']))
	{
		$GLOBALS['language'] = $_POST['language'];
		$_SESSION['language'] = $GLOBALS['language'];
		$_SESSION['configuration'] = $_POST['language'];
	}
}
?>

  <!DOCTYPE html>
  <html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Community</title>

    <!-- Bootstrap CSS -->
    <link href="../bootstrapJs/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google fonts  -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

    <!--- Style Sheet -->
    <link rel="Stylesheet" href="../css/Style.css">
    <link rel="Stylesheet" href="../css/Style_<?=$_SESSION['configuration']?>.css">
	
  </head>

  <body>

    <div class="tagline-upper text-center text-heading text-shadow text-white mt-5 d-none d-lg-block">
      <?php echo localize('Community Rating');?>
    </div>
    <div class="tagline-lower text-center text-expanded text-shadow  text-white mb-5 d-none d-lg-block">Baghchal | Hindi Learning</div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-faded py-lg-4">
      <div class="container">
        <a class="navbar-brand text-uppercase text-expanded font-weight-bold d-lg-none" href="index.php">
          <?php echo localize('Community Rating');?>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav mx-auto">
            <li class="nav-item active px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="index.php">
                <?php echo localize('Home');?>
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="login.php">
                <?php echo localize('Sign in');?>
              </a>
            </li>
            <li class="nav-item px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="signup.php">
                <?php echo localize('Sign Up');?>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container">

      <div class="bg-faded p-4 my-4">
        <!-- Image Carousel -->
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
          </ol>
          <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
              <img class="d-block img-fluid w-100" src="../img/slide-1.png" alt="">
              <div class="carousel-caption d-none d-md-block">
                <h3 class="text-shadow">
                  <?php echo localize('Baghchal');?>
                </h3>
                <p class="text-shadow">
                  <?php echo localize('Play Baghchal Game and Rate Us.');?>
                </p>
              </div>
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid w-100" src="../img/slide-2.jpg" alt="">
              <div class="carousel-caption d-none d-md-block">
                <h3 class="text-shadow">
                  <?php echo localize('Learn Hindi');?>
                </h3>
                <p class="text-shadow">
                  <?php echo localize('Experience learning Language');?>
                </p>
              </div>
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid w-100" src="../img/slide-3.jpg" alt="">
              <div class="carousel-caption d-none d-md-block">
                <h3 class="text-shadow">
                  <?php echo localize('Tiger Goat');?>
                </h3>
                <p class="text-shadow">
                  <?php echo localize('One of the most interesting Game.');?>
                </p>
              </div>
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid w-100" src="../img/slide-4.jpg" alt="">
              <div class="carousel-caption d-none d-md-block">
                <h3 class="text-shadow">
                  <?php echo localize('Hindi');?>
                </h3>
                <p class="text-shadow">
                  <?php echo localize('One of the Indian Language.');?>
                </p>
              </div>
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>


        <!-- Message under Carousel-->
        <div class="text-center mt-4">
          <div class="text-heading text-muted text-lg">Welcome To</div>
          <h1 class="my-2">Community Rating</h1>
          <div class="text-heading text-muted text-lg">By
            <strong>Sujatha Bharathi</strong>
          </div>
        </div>
      </div>

      <div class="bg-faded p-4 my-4">
        <hr class="divider">
        <h2 class="text-center text-lg text-uppercase my-0">
          <?php echo localize('About');?>
          <strong><?php echo localize('Baghchal Game');?></strong>
        </h2>
        <hr class="divider">
        <img class="img-fluid float-left mr-4 d-none d-lg-block" src="../img/baghchal.png" alt="">
        <p>
          <?php echo localize('Baghchal, all time favorite board game of Nepal is now on Android.This game has One player, two player and Bluetooth modes with options to select either goat or tiger.');?>
        </p>
        <p>
          <?php echo localize('Baghchal is one of the traditional board games of Nepal. It is a stratagy based board game. It consists of 20 goats and 4 tigers.The game starts with 4 tigers placed in 4 corners of the board and goats are mounted on the board one at a time.This game can be played alone against android as well as against another player.');?>
        </p>

      </div>

      <div class="bg-faded p-4 my-4">
        <hr class="divider">
        <h2 class="text-center text-lg text-uppercase my-0">
          <?php echo localize('Learning');?>
          <strong><?php echo localize('Hindi Language')?></strong>
        </h2>
        <hr class="divider">
        <img class="img-fluid float-right mr-4 d-none d-lg-block" src="../img/hindi.jpg" alt="">
        <p>
          <?php echo localize('Standard Hindi is based on the Khariboli dialect, the vernacular of Delhi and the surrounding region, which came to replace earlier prestige dialects such as Awadhi, Maithili  and Braj. Urdu is an another form of Hindustani acquired linguistic prestige in the later Mughal period, and underwent significant Persian influence.');?> </p>
        <p>
          <?php echo localize('In the late 19th century, a movement to develop Hindi as a standardised form of Hindustani separate from Urdu took form. In 1881, Bihar accepted Hindi as its sole official language, replacing Urdu, and thus became the first state of India to adopt Hindi.')?>
        </p>
      </div>
    </div>


    <!-- Build DB Modal -->
    <div class="modal fade" data-spy="scroll" data-target="#myModal" data-offset="50" id="myModal" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <img src="../img/db.png" alt="databaseimg" style="height:8%; width:10%;">
            <h2 class="align"><strong>Build Database</strong></h2>
            <button type="button" class="close" data-dismiss="modal">×</button>
          </div>

          <div class="modal-body">
            <form action="index.php" method="POST">
              <div class="input-group">
                <select class="form-control" name="language">
					<option value="English" selected>English</option>
					<option value="Hindi">Hindi</option>		
					</select>
                <span class="input-group-btn">
					<input type="submit" name="submit" value="Select" class="btn btn-secondary">
					</span>
              </div>
              <hr>
              <div>
                <h6 id="buildtxt">
                  <?php echo localize('DBPhrase');?> </h6>
                <a href="../lib/build.php" data-toggle="tooltip" title="Bulid Your Database If you haven't." class="ahref" onclick="data()">
                  <?php echo  localize('BuildDB');?> </a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>


    <!-- footer  -->

    <footer class="bg-faded text-center py-3">
      <div class="container">
        <p class="m-0">Copyright &copy; Sbs0074</p>
      </div>
    </footer>

    <!-- Bootstrap/JavaScript -->
    <script src="../bootstrapJs/jquery/jquery.min.js"></script>
    <script src="../bootstrapJs/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>
  <script type="text/javascript">
    $(window).on('load', function() {
      $('#myModal').modal('show');

    });

    function data() {
      alert('Database Successfully built !');
    }
  </script>

  </html>