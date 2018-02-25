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

</head>
<body>

	<?php
	include_once '../controller/controller.php';
	$ctrlLog = new Controller();
	$ctrlLog->connection();

	$GLOBALS['language'] = 'English';
	$lang = $_SESSION['language'];
	$GLOBALS['language'] = $lang;

	$nameFormat = "";
	$emailFormat = "";
	$logNameFormat = "";
	$passwordFormat = "";
	$mobileNoFormat = "";
	$genderError = "";
	$userNameExists = "";

	// Check before submit

	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		// fname
		if (empty($_POST['fname']))
		{
			$nameFormat = "First Name is Required";
		}
		else
		{
			$fname = test_input($_POST['fname']);
			if (!preg_match("/^[a-zA-Z ]*$/", $fname))
			{
				$nameFormat = "Only Letters & Space Allowed";
			}
		}

		// lname
		if (empty($_POST['lname']))
		{
			$nameFormat = "Last Name is Required";
		}
		else
		{
			$lname = test_input($_POST['lname']);
			if (!preg_match("/^[a-zA-Z ]*$/", $lname))
			{
				$nameFormat = "Only Letters & Space Allowed";
		}
	}

	// emailid
	if (empty($_POST['emailid']))
	{
		$emailFormat = "Email-ID is Required";
	}
	else
	{
		$emailid = test_input($_POST['emailid']);
		if (!filter_var($emailid, FILTER_VALIDATE_EMAIL))
		{
			$emailFormat = "Invalid Email-ID";
		}
	}

	// logname
	if (empty($_POST['logname']))
	{
		$logNameFormat = "Login Name is Required";
	}
	else
	{
		$logname = test_input($_POST['logname']);
		if (!preg_match("/^[a-zA-Z0-9 ]*$/", $logname))
		{
			$logNameFormat = "No Special Characters Allowed";
		}
	}

	// password
	if (empty($_POST['password']))
	{
		$passwordFormat = "Login Name is Required";
	}
	else
	{
		$password = test_input($_POST['password']);
		if (!preg_match("/^[a-zA-Z0-9 ]*$/", $password))
		{
			$passwordFormat = "No Special Characters Allowed";
		}
	}

	// mobileNo
	if (empty($_POST['mobileNo']))
	{
		$mobileNoFormat = "Mobile No is Required";
	}
	else
	{
		$mobileNo = test_input($_POST['mobileNo']);
		if (!filter_var($mobileNo, FILTER_VALIDATE_INT))
		{
			$mobileNoFormat = "Invalid Mobile number";
		}
	}

	// dob
	if (isset($_POST['dob']))
	{
		$dob = $_POST['dob'];
		$dob = str_replace("/", "-", $dob);
	}

	// gender
	if (isset($_POST['gender']))
	{
		$gender = $_POST['gender'];
	}

	// city
	if (isset($_POST['city']))
	{
		$city = $_POST['city'];
	}

	// Check if login name already exists
	if ((checkUserNameExists($db, $logname)->fetch() ['refLoginName']) == $logname)
	{
		$userNameExists = "Login Name Exists";
	}
	else
	{
		// insert into table
		$hasedPassword = password_hash($password, PASSWORD_DEFAULT);
		createNewSignUp($db, $fname, $lname, $emailid, $mobileNo, $logname, $hasedPassword, $dob, $gender, $city);
		header('Location:login.php');
	}
}

function test_input($input)
{
	$input = stripcslashes($input);
	$input = htmlspecialchars($input);
	return $input;
}

?>
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
          <strong><?php echo localize('Sign Up');?></strong>
        </h2>
        <hr class="divider">
        <br/>
		
<!------ Registration Form ----->

        <form id="regform" action="signup.php" method="POST">

          <div class="form-group col-lg-10">
            <div class="input-group">
              <label class="text-heading col-lg-3" for="fname"><span> * </span><?php echo localize('First Name');?> </label>&nbsp; &nbsp;
              <input type="text" class="form-control col-lg-6" name="fname" placeholder="Enter First Name.." required/>
              <span><?php echo $nameFormat;?></span>
            </div>
          </div>

          <div class="form-group col-lg-10">
            <div class="input-group">
              <label class="text-heading col-lg-3" for="lname"><span> * </span> <?php echo localize('Last Name');?></label>&nbsp; &nbsp;
              <input type="text" class="form-control col-lg-6" name="lname" placeholder="Enter Last Name.." required/>
              <span><?php echo $nameFormat;?></span>
            </div>
          </div>

          <div class="form-group col-lg-10">
            <div class="input-group">
              <label class="text-heading col-lg-3" for="emailid"><span> * </span><?php echo localize('E-mail');?></label>&nbsp; &nbsp;
              <input type="email" class="form-control col-lg-6" name="emailid" placeholder="Enter Email-ID.." required/>
              <span><?php echo $emailFormat;?> </span>
            </div>
          </div>

          <div class="form-group col-lg-10">
            <div class="input-group">
              <label class="text-heading col-lg-3" for="mobileNo"><span> * </span><?php echo localize('Mobile');?> </label>&nbsp; &nbsp;
              <input type="text" class="form-control col-lg-6" name="mobileNo" placeholder="Enter mobile number.." required/>
              <span><?php echo $mobileNoFormat;?> </span>
            </div>
          </div>

          <div class="form-group col-lg-10">
            <div class="input-group">
              <label class="text-heading col-lg-3" for="logname"><span> * </span><?php echo localize('User Name');?> </label>&nbsp; &nbsp;
              <input type="text" class="form-control col-lg-6" name="logname" placeholder="Prefered Login name.." required/>
              <span><?php echo $logNameFormat; echo $userNameExists;?> </span>
            </div>
          </div>

          <div class="form-group col-lg-10">
            <div class="input-group">
              <label class="text-heading col-lg-3" for="password"><span> * </span><?php echo localize('Password');?>  </label>&nbsp; &nbsp;
              <input type="password" class="form-control col-lg-6" name="password" placeholder="Enter password.." required/>
              <span><?php echo $passwordFormat;?> </span>
            </div>
          </div>

          <div class="form-group col-lg-10">
            <div class="input-group">
              <label class="text-heading col-lg-3" for="dob"><span> * </span><?php echo localize('DOB');?>  </label>&nbsp; &nbsp;
              <input type="date" class="form-control col-lg-6" name="dob" required/>
            </div>
          </div>

          <div class="form-group col-lg-10">
            <div class="input-group">
              <label class="text-heading col-lg-3" for="gender">&nbsp; <?php echo localize('Gender');?>  </label> &nbsp; &nbsp;
              <label class="radvalue">
					<input type="radio" name="gender"  value="M" checked> <?php echo localize('Male');?> </label> &nbsp; &nbsp;
              <label class="radvalue">
					<input type="radio" name="gender"  value="F"> <?php echo localize('Female');?></label> &nbsp;&nbsp;
              <label class="radvalue">
					<input type="radio" name="gender"  value="O"><?php echo localize('Other');?></label>
            </div>
          </div>

          <div class="form-group col-lg-10">
            <div class="input-group">
              <label class="text-heading col-lg-3" for="city">&nbsp; <?php echo localize('City');?> </label>&nbsp; &nbsp;
              <select class="form-control col-lg-6" name="city">
					  <option value="ChristChurch" selected>ChristChurch</option>
					  <option value="Ashburton">Ashburton</option>
					  <option value="Dunedin">Dunedin</option>
					  <option value="Nelson">Nelson</option>
					  <option value="Blenheim">Blenheim</option>
					</select>
            </div>
          </div>
          <br/>

          <div class="input-group">
            <input type="submit" class="btn btn-secondary col-lg-5" name="submit" value="<?php echo localize('Submit');?>"> &nbsp;&nbsp;
            <input type="reset" class="btn btn-secondary col-lg-5" value="<?php echo localize('Cancel');?>">

          </div>

	  </form>
        <br/>
    </div>
    </div>
	
    <!-- Footer -->
    <footer class="bg-faded text-center py-3">
      <div class="container">
        <p class="m-0">Copyright &copy; Sbs0074</p>
      </div>
    </footer>
	
    <!-- Stylesheet -->
    <link rel="Stylesheet" href="../css/Style.css">
    <link rel="Stylesheet" href="../css/Style_<?=$_SESSION['configuration']?>.css">
	
    <!-- Bootstrap JavaScript -->
    <script src="../bootstrapJs/jquery/jquery.min.js"></script>
    <script src="../bootstrapJs/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>