<?php
class Magazines {
  
   private function __construct() { } 

    
   public static function getAllMagazines(){
        try{
            $con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
            $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            
            //$sql = "SELECT * FROM ".DB_BOOK_TBL;
            $sql = "SELECT * FROM ".DB_MAGAZINE_TBL;
            
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

?>