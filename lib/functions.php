<?php
function redirect($redirecturl) {
	if(!headers_sent()) {
		//If headers not sent yet... then do php redirect
		header('Location: '.$redirecturl);
		exit;
    } else {
        //If headers are sent... do javascript redirect...
        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$redirecturl.'";';
        echo '</script>';
		//If javascript disabled, do html redirect.
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$redirecturl.'" />';
        echo '</noscript>';
        exit;
    }
}

function sec_session_start() {
	
	$session_name = 'sec_session_id';   // Set a custom session name
	$secure = SECURE;
	// This stops JavaScript being able to access the session id.
	$httponly = true;
	// Forces sessions to only use cookies.
	if (ini_set('session.use_only_cookies', 1) === FALSE) {
		header("Location: ../error.php?err=Could not initiate a safe session (ini_set)");
		exit();
	}
	// Gets current cookies params.
	$cookieParams = session_get_cookie_params();
	session_set_cookie_params($cookieParams["lifetime"],
		$cookieParams["path"], 
		$cookieParams["domain"], 
		$secure,
		$httponly);
	// Sets the session name to the one set above.
	session_name($session_name);
	session_start();            // Start the PHP session 
	session_regenerate_id();    // regenerated the session, delete the old one. 
}

function logOutUser(){
	session_start();
    unset($_SESSION);
    session_unset();
    session_destroy();
    redirect('./');
}
function days_diff($d1, $d2) {
    $x1 = days($d1);
    $x2 = days($d2);

    if ($x1 && $x2) {
        return abs($x1 - $x2);
    }
}

function days($x) {
    if (get_class($x) != 'DateTime') {
        return false;
    }

    $y = $x->format('Y') - 1;
    $days = $y * 365;
    $z = (int)($y / 4);
    $days += $z;
    $z = (int)($y / 100);
    $days -= $z;
    $z = (int)($y / 400);
    $days += $z;
    $days += $x->format('z');

    return $days;
}

function dateDifference($date_1 , $date_2 , $differenceFormat = '%a' )
{

    $datetime1 = date_create($date_1);
    $datetime2 = date_create($date_2);

    $interval = date_diff($datetime1, $datetime2);

    return $interval->format($differenceFormat);

}
?>