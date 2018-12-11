<?php
	session_start();
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	$currDir = dirname(__FILE__); 
	include_once("{$currDir}/config/db.php");
	include_once("{$currDir}/class/Users.php");
	include_once("{$currDir}/lib/functions.php");
	
	// according to provided GET parameters, either log out, show login form (possibly with a failed login message), or show homepage
	/*if(isset($_GET['signOut'])){
		logOutUser();
		redirect("index.php?signIn=1");
	}elseif(isset($_GET['loginFailed']) || isset($_GET['signIn'])){
		if(!headers_sent() && isset($_GET['loginFailed'])) header('HTTP/1.0 403 Forbidden');
		include("{$currDir}/login.php");
	}else{
		include("{$currDir}/main.php");
	}*/

	if (isset($_SESSION['userid']) && isset($_SESSION['username'])) {
    	redirect('main.php');
	} else if(isset($_GET['signOut'])){
		logOutUser();
	}else if (isset($_POST["action"])  && $_POST["action"]  == "Login") { 
			$usr = new Users;
			$usr->storeFormValues( $_POST );
		    $msg = $usr->userLogin();
		    if( $msg == "success" ) {
		        redirect('main.php');
		    } else {
		        print_r('<script>alert("You have entered an invalid username/password combination or account inactive.");</script>');
		        redirect('./');
		    }
			
	}

?>

<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Cebu National Library | Admin</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
		============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <!-- Google Fonts
		============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- font awesome CSS
		============================================ -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- owl.carousel CSS
		============================================ -->
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/owl.theme.css">
    <link rel="stylesheet" href="css/owl.transitions.css">
    <!-- meanmenu CSS
		============================================ -->
    <link rel="stylesheet" href="css/meanmenu/meanmenu.min.css">
    <!-- animate CSS
		============================================ -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="css/normalize.css">
    <!-- mCustomScrollbar CSS
		============================================ -->
    <link rel="stylesheet" href="css/scrollbar/jquery.mCustomScrollbar.min.css">
    
    <!-- Notika icon CSS
		============================================ -->
    <link rel="stylesheet" href="css/notika-custom-icon.css">
    <!-- Data Table JS
		============================================ -->
    <link rel="stylesheet" href="css/jquery.dataTables.min.css">
    <!-- main CSS
		============================================ -->
    <link rel="stylesheet" href="css/main.css">
    <!-- style CSS
		============================================ -->
    <link rel="stylesheet" href="css/style.css">
    <!-- responsive CSS
		============================================ -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- modernizr JS
		============================================ -->
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
<!-- Login Register area Start-->
    <div class="login-content">
        <!-- Login -->
        <div class="nk-block toggled" id="l-login">
        	<form method="post" action="" name="login" id="login-form">
	            <div class="nk-form">
	                <div class="input-group">
	                    <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-support"></i></span>
	                    <div class="nk-int-st">
	                        <input type="text" class="form-control" placeholder="Username" name="username" required>
	                    </div>
	                </div>
	                <div class="input-group mg-t-15">
	                    <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-edit"></i></span>
	                    <div class="nk-int-st">
	                        <input type="password" class="form-control" placeholder="Password" name="password" required>
	                    </div>
	                </div>
	                <div class="fm-checkbox">
	                    <label><input type="checkbox" class="i-checks"> <i></i> Keep me signed in</label>
	                    <input type="hidden" name="action" value="login">
	                </div>
	                <!-- <a href="#l-register" data-ma-action="nk-login-switch" data-ma-block="#l-register" class="btn btn-login btn-success btn-float" id="login"><i class="notika-icon notika-right-arrow right-arrow-ant"></i></a> -->

	                <div class="btn-list mg-tb-20">
                            <input type="submit" class="btn btn-success notika-btn-success waves-effect" value="Login" name="action"></input>
                    </div>
	            </div>
	          
	         </form>   
        </div>

    </div>
    <!-- Login Register area End-->
<?php
	include_once("{$currDir}/template/footer.php"); ?>

<script type='text/javascript'>
    $(document).ready(function() {
    	
    	/*$('#login').on('click', function(e){
    		 e.preventDefault();
    		 alert('login');
    		 $('#login-form').submit();

    	});*/
    });
</script>
</body>

</html>

