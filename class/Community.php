<?php

class Community {

    private $community;
    private $name;
    private $description;
    private $allowSignup;
    private $needsApproval;

    public function __construct()
    {

    }

    /** setters **/

    public function setCommunity($community)
    {
        $this->community = $community;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setAllowSignup($allowSignup)
    {
        $this->allowSignup = $allowSignup;
    }

    public function setNeedsApproval($needsApproval)
    {
        $this->needsApproval = $needsApproval;
    }

    /** etters **/

    public function getCommunity()
    {
        return $this->community;
    }

    public function getName()
    {
        return $this->name ;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getAllowSignup()
    {
        return $this->allowSignup;
    }

    public function getNeedsApproval()
    {
        return $this->needsApproval;
    }

    public static function getAllCommunity()
    {
        try{
            $con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
            $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

            $sql = "SELECT * FROM ".DB_COMMUNITY_TBL;

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