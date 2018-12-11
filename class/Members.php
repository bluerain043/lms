<?php
class Members {
  

    const IS_BANNED = 1;
    const IS_NOT_BANNED = 0;

    private $members;
    private $name;
    private $contact;
    private $email;
    private $signup_date;
    private $community;
    private $is_banned;

    public function __construct( $arData = [] ) {
        if(isset($arData['members']) ) $this->members = stripslashes( strip_tags( $arData['members'] ) );
        if(isset($arData['name']) ) $this->name = stripslashes( strip_tags( $arData['name'] ) );
        if(isset($arData['contact']) ) $this->contact = stripslashes( strip_tags( $arData['contact'] ) );
        if(isset($arData['email']) ) $this->email = stripslashes( strip_tags( $arData['email'] ) );
        if(isset($arData['signup_date']) ) $this->signup_date = stripslashes( strip_tags( $arData['signup_date'] ) );
        if(isset($arData['community']) ) $this->community = stripslashes( strip_tags( $arData['community'] ) );
        if(isset($arData['is_banned']) ) $this->is_banned = stripslashes( strip_tags( $arData['is_banned'] ) );
    }

    /*** setters ***/

    public function setMembers($members){
        $this->members = $members;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setContact($contact)
    {
        $this->contact = $contact;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setSignupDate($signup_date)
    {
        $this->signup_date = date('Y-m-d', strtotime($signup_date));
    }

    public function setCommunity($community)
    {
        $this->community = $community;
    }

    public function setIsBanned($is_banned)
    {
        $this->is_banned = $is_banned;
    }

    /** getters **/

    public function getMembers(){
        return $this->members;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getContact()
    {
        return $this->contact;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getSignupDate()
    {
        return $this->signup_date;
    }

    public function getCommunity()
    {
        return $this->community;
    }

    public function getIsBanned()
    {
        return $this->is_banned;
    }

   public static function getActiveMembers(){
        try{
            $con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
            $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            
            $sql = "SELECT * FROM ".DB_MEMBERS_TBL. " WHERE is_banned =".Members::IS_NOT_BANNED;
            
            $stmt = $con->prepare( $sql );
            $stmt->execute();
            if ($stmt->rowCount() > 0) {            
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
                
            }else return null;
            $con = null;
            
        }catch (PDOException $e) {
            return $e->getMessage();
        }
   }



    public static function checkIsBanned($member)
    {
        try{
            $con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
            $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

            $sql = "SELECT * FROM ".DB_MEMBERS_TBL. " WHERE is_banned =".Members::IS_BANNED. " AND members =".$member;

            $stmt = $con->prepare( $sql );
            $stmt->execute();
            return $stmt->rowCount();
            $con = null;

        }catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function currentlyLoanBooks($member)
    {
        try{
            $con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
            $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

            $sql = "SELECT * FROM ".DB_MEMBERS_TBL. " WHERE members =".$member;

            $stmt = $con->prepare( $sql );
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);

            }else return null;
            $con = null;

        }catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
