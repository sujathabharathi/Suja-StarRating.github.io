<?php
include_once '../controller/controller.php';

$ctrl = new Controller();
$ctrl->connection();
$GLOBALS['language'] = 'English';
$lang = $_SESSION['language'];
$GLOBALS['language'] = $lang;

if (isset($_SESSION['theUserID']))
{

	// theUserID is set
	$loginId = $_SESSION['theUserID'];
	$userName = getUserName($db, $loginId);
	$row = $userName->fetch();
	$myName = $row['regFname'] . " " . $row['regLname'];
	$show = '';
}
else
if (isset($_SESSION['theAdminID']))
{

	// theAdminID is set
	$adminID = $_SESSION['theAdminID'];
	$userName = getUserName($db, $adminID);
	$row = $userName->fetch();
	$myName = $row['regFname'] . " " . $row['regLname'] . ' Admin';
	$show = "<a href='displaytables.php'><h2 class='text-center'><button class ='btn btn-secondary'> See All Tables </button></h2></a><hr class='divider'>";
}

$theWord = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	if (isset($_POST['postComment']))
	{
		if (isset($_POST['ratedCom']))
		{
			$ratedCom = $_POST['ratedCom'];
		}

		if (isset($_POST['star']))
		{
			$star = $_POST['star'];
		}

		if (empty($_POST['Usercomments']))
		{
			echo "please add Ur Comments";
		}
		else
		{
			$Usercomments = test($_POST['Usercomments']);
		}

		$date = "";
		newUseerReview($db, $loginId, $star, $date, $ratedCom, $Usercomments);
		newAdminReview($db, $adminID, $star, $date, $ratedCom, $Usercomments);
		header('Location:userReview.php');
	}
	else
	if (isset($_POST['search']))
	{
		if (isset($_POST['theWord']))
		{
			$theWord = test($_POST['theWord']);
		}
	}
}

$chart = new chartMaker($db);

// Total Number of Users
$noOfUsers = $chart->getNoOfUsers($db)->fetch();
foreach($noOfUsers as $key => $value)
{
	$totalUser = $value;
}

// Average rating
$avgRating = $chart->AverageStarRate($db)->fetch();
foreach($avgRating as $key => $value)
{
	$avgvalue = $value;
}
$avg = number_format($avgvalue, 1);

// star 5 percentage
$star5percent = $chart->star5($db)->fetch();
foreach($star5percent as $key => $value)
{
	$star5value = $value;
}
$star5 = round($star5value);

// star 4 percentage
$star4percent = $chart->star4($db)->fetch();
foreach($star4percent as $key => $value)
{
	$star4value = $value;
}
$star4 = round($star4value);

// star 3 percentage
$star3percent = $chart->star3($db)->fetch();
foreach($star3percent as $key => $value)
{
	$star3value = $value;
}
$star3 = round($star3value);

// star 2 percentage
$star2percent = $chart->star2($db)->fetch();

foreach($star2percent as $key => $value)
{
	$star2value = $value;
}
$star2 = round($star2value);

// star 1 percentage
$star1percent = $chart->star1($db)->fetch();

foreach($star1percent as $key => $value)
{
	$star1value = $value;
}
$star1 = round($star1value);
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

<style type="text/css">

#bar-five {
  width:<?php echo $star5;?>%;
  background-color: #006000; 
}

#bar-four {
  width:<?php echo $star4;?>%;
  background-color: #7FFF00;  
}

#bar-three {
  width: <?php echo $star3;?>%;
  background-color: #FFFF00;  
}

#bar-two {
  width: <?php echo $star2;?>%;
  background-color: #ff6600;
}

#bar-one {
  width: <?php echo $star1;?>%;
  background-color: #ff0000;   
} 
</style>
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
              <a class="nav-link text-uppercase text-expanded" href="index.php"><?php echo localize('Home');?>
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="login.php"><?php echo localize('Sign in');?></a>
            </li>
            <li class="nav-item px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="signup.php"><?php echo localize('Sign Up');?></a>
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
          <strong><?php echo localize('User Rating');?></strong>
        </h2>
        <hr class="divider">
	
		
		<?php echo "<br/><h2 class='text-center text-expanded'> <strong>  Welcome <br/> $myName </strong></h2><br/> $show <br/>"; ?> 
		
		
			
		<div class="col-lg-8 container" >		
        <form id="rateform" action ="userreview.php" method="POST">
		
		
		
		
		<div class="input-group col-lg-8">	
		<label class="text-heading col-lg-6" for ="ratedCom "><?php echo localize('Select Community');?></label>		
					<select  autofocus class="form-control col-lg-6"name="ratedCom">
					<option value="hindi">Hindi</option>
					 <option value="bagchal">Bagchal</option>		
					</select>
					</div>
			
					
				
			<div class="col-lg-9">
					<input class="star star-5" id="star-5" type="radio" value="5" name="star"/>
					<label class="star star-5" for="star-5" title="LOVE IT"></label>
					<input class="star star-4" id="star-4" type="radio" value="4" name="star"/>
					<label class="star star-4" for="star-4" title="LIKE IT"></label>
					<input class="star star-3" id="star-3" type="radio" value="3"name="star"/>
					<label class="star star-3" for="star-3" title="JUST OK"></label>
					<input class="star star-2" id="star-2" type="radio"  value="2" name="star"/>
					<label class="star star-2" for="star-2" title="DIDN'T LIKE IT"></label>
					<input class="star star-1" id="star-1" type="radio" value="1"name="star"/>
					<label class="star star-1" for="star-1" title="HATE IT"></label>
			</div>
			
		
	<textarea rows="3"  class="form-control col-lg-6" name="Usercomments"  placeholder="Tell others what you think about us..." required></textarea>
	
	<br/>
	
	<div class="input-group">
					<input type="submit" name="postComment" value="Sumbit" class="btn btn-secondary col-lg-2 btnalign">&nbsp;
		<input type ="reset" value="Reset" class="btn btn-secondary col-lg-2">
			</div>
		</form>
				
		
		
			<br/>
			<br/>
			<div class="container">
				<div class="inner">
					<div class="rating">
						<span class="rating-num"> <?php echo $avg;?> </span> <!-- Average Rating--><br/>
						<div class="rating-users"> <!-- total no of users-->
						 <?php echo ($totalUser); ?> <br/>Total Users
					</div>
				</div>

				<div class="histo">
				<div class="outter">
					<span class="histo-star">5</span>
					<span class="bar-block">
					<span id="bar-five" class="bar">
					<span class="fontt"><?php echo $star5;?>%</span>&nbsp;
					</span> 
					</span>
				</div>

				<div class="four histo-rate">
					<span class="histo-star">4</span>
					<span class="bar-block">
					<span id="bar-four" class="bar">
					<span class="fontt"><?php echo $star4;?>%</span>&nbsp;
					</span> 
					</span>
				</div> 

				<div class="three histo-rate">
					<span class="histo-star">3</span>
					<span class="bar-block">
					<span id="bar-three" class="bar">
					<span class="fontt"><?php echo $star3;?>%</span>&nbsp;
					</span> 
					</span>
				</div>

				<div class="two histo-rate">
					<span class="histo-star">2</span>
					<span class="bar-block">
					<span id="bar-two" class="bar">
					<span class="fontt"><?php echo $star2;?>%</span>&nbsp;
					</span> 
					</span>
				</div>

				<div class="one histo-rate">
					<span class="histo-star">1</span>
					<span class="bar-block">
					<span id="bar-one" class="bar">
					<span class="fontt"><?php echo $star1;?>%</span>&nbsp;
					</span> 
					</span>
				</div>
				</div>
				
			</div>
		</div>
		
</div>	
 <br/>	
 <hr>
 <hr class="divider">
        <h2 class="text-center text-lg text-uppercase my-0">
          <strong><?php echo localize('Posted Comments');?></strong>
        </h2>
        <hr class="divider">		


 		
 <br/>	
 <form style ="margin-left:20em;" action ="userreview.php" method="POST">
 	<div class="input-group">
 <input class="form-control col-lg-5" id='word' type ="text" name ="theWord" >
 <input type ="submit" name ="search"  onclick ="btnSearch()" class="btn btn-secondary col-lg-2" value="Search">
 </div>
 </form>
 <br/>
<div  class="col-lg-5" style="overflow:hidden; overflow-y: scroll;height: 600px; padding:1em; margin-left:20em;">

<?php

if($theWord =="" )
	{
		$bfrSearchResult = new DesignTable($db);
		$result = $bfrSearchResult->getComments($db,$theWord);
		$bfrSearchResult->displayComments($result);
	}
	else if($theWord != "")
	{
		$table = new TableMaker($db);
		$searchResult= $table->getPostedCommets($db,$theWord);
		$table->displayPostedComments($searchResult);		
	}

?>
</div>

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
