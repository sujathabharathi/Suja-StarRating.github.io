<?php
include_once '../controller/controller.php';

$ctrlLog = new Controller();
$ctrlLog->connection();
$GLOBALS['language'] = 'English';
$lang = $_SESSION['language'];
$GLOBALS['language'] = $lang;

function isValidLogin($theUserName, $thePassword)
{
	$result = true;
	if ($theUserName == '')
	{
		$result = false;
		echo '<script language="javascript">alert("Please fill User Name");</script>';
	}

	if ($thePassword == '')
	{
		$result = false;
		echo '<script language="javascript">alert("Please fill the Password");</script>';
	}

	return $result;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	if (isset($_POST['login']))
	{
		if (isset($_POST['theUserName']))
		{
			$theUserName = test($_POST['theUserName']);
		}

		if (isset($_POST['thePassword']))
		{
			$thePassword = test($_POST['thePassword']);
		}

		if ($theUserName == "suja16" && $thePassword == "suja1603")
		{
			$theAdminID = getUserDetails($db, $theUserName, $thePassword);
			if ($theAdminID == true)
			{
				$_SESSION['theAdminID'] = getIDFromLogin($db, $theUserName)->fetch() ['logID'];
				header('Location:userReview.php');
			}
		}
		else
		if (isValidLogin($theUserName, $thePassword))
		{
			$theUserID = getUserDetails($db, $theUserName, $thePassword);
			if (!$theUserID)
			{
				$result = false;
				echo "Not a valid UserName and Password<br/>";
			}
			else
			if ($theUserID)
			{
				$_SESSION['theUserID'] = getIDFromLogin($db, $theUserName)->fetch() ['logID'];
				header('Location:userReview.php');
			}
		}
	}
	else
	if (isset($_POST['newPass']))
	{
		if (isset($_POST['newPassword']))
		{
			$newPassword = test($_POST['newPassword']);
		}

		if (isset($_POST['newPassword2']))
		{
			$newPassword2 = test($_POST['newPassword2']);
		}

		if (isset($_POST['logname']))
		{
			$logname = test($_POST['logname']);
		}

		if ((checkUserNameExists($db, $logname)->fetch() ['refLoginName']) == $logname)
		{
			$hash = getHashedPassword($db, $logname)->fetch() ['regPassword'];
			$result = password_verify($newPassword, $hash);
			if ($result == true)
			{
				$id = getIDFromLogin($db, $logname)->fetch() ['logID'];
				$newHash = password_hash($newPassword2, PASSWORD_DEFAULT);
				updatePassword($db, $id, $newHash);
			}
		}
	}
}

$checkboxInput = '';

if (isset($_POST['rememerme']))
{
	$checkboxInput = $_POST['rememberme'];
}

if ($checkboxInput == 'on')
{
	$_SESSION["rememberUser"] = $theUserName;
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

    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

    <link href="https://fonts.googleapis.com/css?family=Berkshire+Swash" rel="stylesheet">

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
        <hr class="divider">
        <h2 class="text-center text-lg text-uppercase my-0">
          <strong><?php echo localize('Sign in');?></strong>
        </h2>
        <hr class="divider">
        <div class="row">
          <div class="col-lg-6">
            <img class="img-fluid mb-4 mb-lg-0" src="../img/slide-2.jpg" alt="">
          </div>
          <div class="col-lg-6">
		  
			<!-- Login Form -->
            <form action="login.php" method="POST" id="logs">

              <div class="form-group col-lg-8">
                <label class="text-heading" for="theUserName"><?php echo localize('User Name');?>   </label>
                <input type="text" class="form-control" name="theUserName" placeholder="<?php echo localize('Enter Login name');?>..." value="<?php 
                    if(isset($_SESSION[" rememberUser "]))
                    {
                        echo $_SESSION["rememberUser "];
                    }
                    ?>"/>
              </div>

              <div class="form-group col-lg-8">
                <label class="text-heading" for="thePassword"><?php echo localize('Password');?>  </label>
                <input type="password" name="thePassword" placeholder="<?php echo localize('Enter the Password');?> ..." class="form-control" />
              </div>

              <div class="form-group col-lg-9">
                <input type="checkbox" name="rememberme"> <strong><?php echo localize('Remember My Username');?></strong><br/>
              </div>

              <div class="form-group col-lg-12">
                <input type="submit" name="login" class="btn btn-secondary" value="<?php echo localize('Login');?>">
                <input type="reset" class="btn btn-secondary" value="<?php echo localize('Cancel');?>">

                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#myChangeModal" onclick="hide()">	<?php echo localize('Change Password');?>	</button>
              </div>

            </form>
          </div>
        </div>
      </div>

      <div class="bg-faded p-4 my-4">
        <hr class="divider">
        <h2 class="text-center text-lg text-uppercase my-0">
          <strong>Features</strong>
        </h2>
        <hr class="divider">
        <div class="bg-faded p-4 my-4">

          <div id="textCarousel" class="carousel slide" data-ride="carousel">

            <div class="carousel-inner" role="listbox">
              <div class="carousel-item active">
                <div class="carousel-content">
                  <div>
                    <h2 class="txtCarH2"> Role Management </h2>
                    <p class="text-shadow"> Login as Admin / User </p>
                  </div>
                </div>
              </div>

              <div class="carousel-item">
                <div class="carousel-content">
                  <div>
                    <h2 class="txtCarH2"> Register </h2>
                    <p class="text-shadow"> New User Entry </p>
                  </div>
                </div>
              </div>

              <div class="carousel-item">
                <div class="carousel-content">
                  <div>
                    <h2 class="txtCarH2"> Change Password </h2>
                    <p class="text-shadow"> Facility to update Password </p>
                  </div>
                </div>
              </div>

              <div class="carousel-item">
                <div class="carousel-content">
                  <div>
                    <h2 class="txtCarH2"> Remember User Name </h2>
                    <p class="text-shadow"> Don't need to Memorize </p>
                  </div>
                </div>
              </div>

              <div class="carousel-item">
                <div class="carousel-content">
                  <div>
                    <h2 class="txtCarH2"> Rating </h2>
                    <p class="text-shadow"> Rate about the Communities </p>
                  </div>
                </div>
              </div>

              <div class="carousel-item">
                <div class="carousel-content">
                  <div>
                    <h2 class="txtCarH2"> Comments </h2>
                    <p class="text-shadow"> Post Your Feedback</p>
                  </div>
                </div>
              </div>

              <div class="carousel-item">
                <div class="carousel-content">
                  <div>
                    <h2 class="txtCarH2">Chart about Rating</h2>
                    <p class="text-shadow"> Reviews </p>
                  </div>
                </div>
              </div>

              <div class="carousel-item">
                <div class="carousel-content">
                  <div>
                    <h2 class="txtCarH2"> Search </h2>
                    <p class="text-shadow"> Search comments by User or Star Rate</p>
                  </div>
                </div>
              </div>

              <div class="carousel-item">
                <div class="carousel-content">
                  <div>
                    <h2 class="txtCarH2"> Internationalization </h2>
                    <p> Hindi / English</p>
                  </div>
                </div>
              </div>

              <div class="carousel-item">
                <div class="carousel-content">
                  <div>
                    <h2 class="txtCarH2"> Different Themes </h2>
                    <p> Changing the background</p>
                  </div>
                </div>
              </div>

              <div class="carousel-item">
                <div class="carousel-content">
                  <div>
                    <h2 class="txtCarH2"> Security</h2>
                    <p>Protection ~ Cross Site Scripting & SQL Injection, Session Management</p>
                  </div>
                </div>
              </div>

              <a class="carousel-control-prev" href="#textCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
              <a class="carousel-control-next" href="#textCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
            </div>

            <br/>
            <div class="text-center mt-4">

              <hr class="divider">
              <div class="text-heading text-muted text-lg">By
                <strong>Sujatha Bharathi</strong>
              </div>

            </div>
          </div>

        </div>


        <!-- Change Password Modal-->

        <div class="modal fade" data-spy="scroll" data-target="#myChangeModal" data-offset="50" id="myChangeModal" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <img src="../img/cp.png" alt="databaseimg" style="height:15%; width:10%;">
                <h2 class="align"><strong>Change Password</strong></h2>
                <button type="button" class="close" data-dismiss="modal">×</button>
              </div>

              <div class="modal-body">

                <form action="login.php" method="POST">

                  <div class="form-group col-lg-8">
                    <label class="text-heading" for="logname">User Name </label>
                    <input type="text" class="form-control" name="logname" placeholder="Enter Login name.." required/>
                  </div>

                  <div class="form-group col-lg-8">
                    <label class="text-heading" for="newPassword">Old Password</label>
                    <input type="password" name="newPassword" placeholder="Enter Old Password.." class="form-control" required/>
                  </div>

                  <div class="form-group col-lg-8">
                    <label class="text-heading" for="newPassword2">New Password</label>
                    <input type="password" name="newPassword2" placeholder="Enter New Password.." class="form-control" required/>
                  </div>

                  <div class="form-group col-lg-12">
                    <input type="submit" name="newPass" class="btn btn-secondary" value="Change">
                    <input type="reset" class="btn btn-secondary" value="Cancel">
                  </div>

                </form>
              </div>
            </div>
          </div>
        </div>
		
        <!-- Footer -->

        <footer class="bg-faded text-center py-3">
          <div class="container">
            <p class="m-0">Copyright &copy; Sbs0074</p>
          </div>
        </footer>

        <!-- Bootstrap  JavaScript -->
        <script src="../bootstrapJs/jquery/jquery.min.js"></script>
        <script src="../bootstrapJs/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

  </html>