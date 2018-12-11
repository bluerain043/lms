<?php
class Users {
    private $salt = "e;am7iy+b1:([R8Zg0c|r;+|5V3#y@,|8K|IO6O*aO*V-5&r-%Z6*TZy)>]m-|E$";

    public function __construct( $data = array() ) {
        if( isset( $data['username'] ) ) $this->username = stripslashes( strip_tags( $data['username'] ) );
        if( isset( $data['password'] ) ) $this->password = hash("sha256", stripslashes( strip_tags( $data['password'] ) ) . $this->salt);
        if( isset( $data['name'] ) ) $this->emailaddress = stripslashes( strip_tags( $data['email'] ) );
        
        /***** account activation variables ******/
        if( isset( $data['userid'] ) ) $this->uid = stripslashes( strip_tags( $data['id'] ) );
        if( isset( $data['email'] ) ) $this->email = stripslashes( strip_tags( $data['email'] ) );
        
    }
    
    public function storeFormValues( $params ) {
        $this->__construct( $params ); 
    }
	
	public function userLogin() {
        $msg = "failed";
        try{
            $con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
            $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            
            $sql = "SELECT * FROM ".DB_USER_TBL." WHERE username = '$this->username' AND password = '$this->password'  LIMIT 1";
			
			$stmt = $con->prepare( $sql );
            $stmt->execute();
            echo "<script>alert('".$sql."')</script>";
            if ($stmt->rowCount() > 0) {			
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($row['password'] == $this->password && $row['is_active'] == 1) {
                    $_SESSION['userid'] = $row['users'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['contact'] = $row['contact'];
                    $msg = "success";   
                }	
            }
            $con = null;
            return $msg;
        }catch (PDOException $e) {
            return $e->getMessage();
        }
    }
	

    public function register() {
        try {
        
            if($this->checkEmail($this->emailaddress)){
                
                $con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
                $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
                
                $sql = "SELECT * FROM ".DB_TABLE." WHERE username = '$this->emailaddress' OR email = '$this->emailaddress' LIMIT 1";
                $stmt = $con->prepare( $sql );
                $stmt->execute();
                if ($stmt->rowCount() == 0) {
                    $sql = "INSERT INTO ".DB_TABLE." (username, password, email) VALUES('$this->emailaddress', '$this->password', '$this->emailaddress')";
                    $stmt = $con->prepare( $sql );
                    $stmt->execute();
                    $insID = $con->lastInsertId();
                    print_r('<script>alert("Registration Successful")</script>');
                    
                    
                    $this->sendAccountCreationEmail("support@jabagat.com");
                    $this->sendAccountCreationEmail("danm@jabagat.com");
                    $this->sendActivationEmail($insID);
                    $this->addToMailchimp();
                   
                    
                } else {
                    print_r('<script>alert("Sorry, but that username has already been taken. Please try again")</script>');
                    print_r('<META HTTP-EQUIV="Refresh" Content="0; URL=./">');
                }
            }else{
                 print_r('<script>alert("Invalid Email Address! Please use a valid email address")</script>');
            }       
        }catch( PDOException $e ) {
            print_r('<script>alert("Error '.$stmt->errorCode().' has occurred. Please contact support@woystermedia.com and try again later.")</script>');
        }
    }
		
	public function forgotPassword() {
    try {
        $con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		
		$expFormat = mktime(date("H"), date("i"), date("s"), date("m")  , date("d")+1, date("Y"));
        $expDate = date("Y-m-d H:i:s",$expFormat);
		
        $sql = "SELECT * FROM ".DB_TABLE." WHERE username = '$this->emailaddress'";
        $stmt = $con->prepare( $sql );
        $stmt->execute();
            if ($stmt->rowCount() > 0) {    
                $headers = "From: Cebu National Library \r\n"."MIME-Version: 1.0\r\n"."Content-Type: text/html;\r\n";
                $Body = "Hi $this->emailaddress ,<br>";


                $emailTo = $this->emailaddress;
                $subject = "Reset Your CNL Password";

                $headers = "From: CNL Admin\r\n";
                $headers .= "Reply-To: support@gale.com\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html;\r\n";

                $activation_url="http://dailyshare.woystermedia.com/forgotPassword.php?user=".base64_encode($this->emailaddress)."&date=".base64_encode($expDate);


                $Body  = "Your <em>Dailyshare</em>&trade; has been reset!";
                $Body .= "<br><br>";
                $Body .= "Below is a link to reset your account password.<br>";
                $Body .= "Please <a href=".$activation_url.">Click Here</a>! ";
                $Body .= "<br><br>";
                $Body .= "Sincerely, <br>";
                $Body .= "<strong>The Woyster Media Team</strong>";


                $sent = mail($emailTo, $subject, $Body, $headers);
                //echo "<script>alert('".$sent."');</script>";
                print_r('<script>alert("An email has been sent to you with instructions on how to reset your password!")</script>');
                print_r('<META HTTP-EQUIV="Refresh" Content="0; URL=./">');
                         
            } else {
                print_r('<script>alert("Sorry the email address used has not been registered!")</script>');
                print_r('<META HTTP-EQUIV="Refresh" Content="0; URL=./">');
            }
        }catch( PDOException $e ) {
            print_r('<script>alert("Error '.$stmt->errorCode().' has occurred. Please contact support@woystermedia.com and try again later.")</script>');
        }
    }
	
	
	
    public function resetPassword() {
     try {

            $con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
            $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

            if(isset($_GET['date'])){
                 /******* CHECK FOR PASSWORD REST TIMEOUT ********/
                
                 $expDate = base64_decode($_GET['date']);
                 $nowDate = date("Y-m-d H:i:s", time());

                if(strtotime($nowDate) > strtotime($expDate) ){
                       print_r('<script>alert("Link is invalid or has expired!")</script>');
                        print_r('<META HTTP-EQUIV="Refresh" Content="0; URL=./forgotPassword.php">');
               }else{
                       $sql = "UPDATE ".DB_TABLE." SET password=? WHERE username=?";
                       $stmt = $con->prepare($sql);
                       $stmt->execute(array($this->password,$this->emailaddress));

                       print_r('<script>alert("Password Reset is Successful!")</script>');
                       print_r('<META HTTP-EQUIV="Refresh" Content="0; URL=./index.php">');
                }
            }else{
                
                $sql = "UPDATE ".DB_TABLE." SET password=?, reset_pass_on_login=? WHERE username=?";
                $stmt = $con->prepare($sql);
                $stmt->execute(array($this->password,'0',$this->emailaddress));

                print_r('<script>alert("Password Reset is Successful!")</script>');
                print_r('<META HTTP-EQUIV="Refresh" Content="0; URL=./index.php">');
            }
            

        }catch( PDOException $e ) {
            print_r('<script>alert("Error '.$stmt->errorCode().' has occurred. Please contact support@woystermedia.com and try again later.")</script>');
        }
        }
	
    
    public function sendAccountCreationEmail($emailTo) {
        $headers = "From: DailyShareAdmin \r\n"."MIME-Version: 1.0\r\n"."Content-Type: text/html;\r\n";
        $headers .= "Reply-To: support@woystermedia.com\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html;\r\n";
        
        $subject = "New Dailyshare User";
        $Body =  "New Dailyshare User:<br>";
        $Body .= "Email Address: $this->emailaddress<br>";
        $Body .= "Name: $this->fname $this->lname<br>";
        $sent = mail($emailTo, $subject, $Body, $headers);
        return $sent;
    }
    
    public function sendActivationEmail($insID) {
        $headers = "From: DailyShareAdmin \r\n"."MIME-Version: 1.0\r\n"."Content-Type: text/html;\r\n";
        
        $subject = "DailyShare Confirmation Email";

        $headers = "From: DailyShareAdmin\r\n";
        $headers .= "Reply-To: support@woystermedia.com\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html;\r\n";

        //$activation_url="http://localhost:81/WOYSTER-Dailyshare/initForm.php?userid=".base64_encode($insID)."&email=".base64_encode($this->emailaddress);
        $activation_url="http://test.woystermedia.com/dailyshare/initForm.php?userid=".base64_encode($insID)."&email=".base64_encode($this->emailaddress);

        $Body  = "<strong>Dear, ".$this->fname."</strong>";
        $Body .= "<br><br>	";
        $Body .= "Thank you for signing up with <em>Dailyshare</em>&trade;!<br><br>";
        $Body .= "Woyster Media wants to help you increase your social media engagement, and we have designed <em>Dailyshare</em>&trade; to help you do just that!";
        $Body .= "<br><br>	";
        $Body .= "Below is a link to complete your account activation.<br>";
        $Body .= "<a href=".$activation_url.">Click Here</a> to activate your account! ";
        $Body .= "<br><br>	";
        $Body .= "Sincerely, <br>";
        $Body .= "<strong>The Woyster Media Team</strong>";

        $sent = mail($this->emailaddress, $subject, $Body, $headers);
        return $sent;
    }
    
    
	private function checkEmail($email) {
     
        // First, we check that there's one @ symbol, and that the lengths are right.
        if (!preg_match("/^[^@]{1,64}@[^@]{1,255}$/", $email)) {
          // Email invalid because wrong number of characters in one section or wrong number of @ symbols.
           return false;
       }
        // Split it into sections to make life easier
        $email_array = explode("@", $email);
        $local_array = explode(".", $email_array[0]); 
        for ($i = 0; $i < sizeof($local_array); $i++) {
          if (!preg_match("/^(([A-Za-z0-9!#$%&'*+=?^_`{|}~-][A-Za-z0-9!#$%&↪'*+=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$/", $local_array[$i])) {  
            return false;
          }
        }
        
        if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $email_array[1]))
        {   // character not valid in domain part
           return false;
        }else if (preg_match('/\\.\\./', $email_array[1])){
           // domain part has two consecutive dots
           return false;
        }else if (!(checkdnsrr($email_array[1],"MX") || checkdnsrr($email_array[1], "A"))){
           // domain not found in DNS
           return false;
        }
      return true;
      }   
      
      
     public function defaultEntry() {
        $msg = "failed";
        try{
            $con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
            $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            
            
            $uid = base64_decode($this->uid);
            $uname = base64_decode($this->email);
            
            $sql = "UPDATE ".DB_TABLE." SET first_name=?, last_name=?, keyword1=?, keyword2=?, keyword3=? WHERE username = '$uname' AND userid = '$uid'";
            $stmt = $con->prepare($sql);
            $exec = $stmt->execute(array($this->fname, $this->lname, $this->keyword1, $this->keyword2, $this->keyword3));
           
            if($exec > 0){$msg = "success";}
            $con = null;
            return $msg;
        }catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    
    
    public function defaultEntryPassword() { 
        $msg = "failed";
        try{
            $con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
            $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            
            $uid = base64_decode($this->uid);
            $email = base64_decode($this->email);
            
            $sql = "UPDATE ".DB_TABLE." SET password = ? WHERE username = ? OR email = ? AND userid = ?";
            $stmt = $con->prepare($sql);
            $exec = $stmt->execute(array($this->password, $email, $email, $uid));
           
            if($exec > 0){$msg = "success";}
            $con = null;
            return $msg;
        }catch (PDOException $e) {
            return $e->getMessage();
        }
    }
      
    public function activateAccount(){
        $uid = base64_decode($this->uid);
        $email = base64_decode($this->email);
        $msg = "failed";
        try{
            $con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
            $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            
            //demo_myWoyster_login $sql = "UPDATE ".DB_TABLE." SET first_name=?, last_name=?, keyword1=?, keyword2=?, keyword3=? WHERE username = '$uname' AND userid = '$uid'";
            $sql = "UPDATE ".DB_TABLE." SET active = ? WHERE username = ? OR email = ? AND userid = ?";
            $stmt = $con->prepare($sql);
            $exec = $stmt->execute(array('1', $email, $email, $uid));
           
            if($exec > 0){$msg = "success";}
            $con = null;
            return $msg;
        }catch (PDOException $e) {
            return $e->getMessage();
        }
        
    }
      
    
}

?>