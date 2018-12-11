<?php
class Newspapers {

    private $newspaper;
    private $language;
    private $name;
    private $date_of_receipt;
    private $date_published;
    private $pages;
    private $price;
    private $publisher;

    public function __construct($arData = []) {
        if(isset($arData['newspaper']) ) $this->newspaper = stripslashes( strip_tags( $arData['newspaper'] ) );
        if(isset($arData['language']) ) $this->language = stripslashes( strip_tags( $arData['language'] ) );
        if(isset($arData['name']) ) $this->name = stripslashes( strip_tags( $arData['name'] ) );
        if(isset($arData['date_of_receipt']) ) $this->date_of_receipt = date('Y-m-d', strtotime($arData['date_of_receipt']));
        if(isset($arData['date_published']) ) $this->date_published = date('Y-m-d', strtotime($arData['date_published']));
        if(isset($arData['pages']) ) $this->pages = stripslashes( strip_tags( $arData['pages'] ) );
        if(isset($arData['price']) ) $this->price = stripslashes( strip_tags( $arData['price'] ) );
        if(isset($arData['publisher']) ) $this->publisher = stripslashes( strip_tags( $arData['publisher'] ) );
    }

    
   public static function getAllNewspapers(){
        try{
            $con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
            $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            
            //$sql = "SELECT * FROM ".DB_BOOK_TBL;
            $sql = "SELECT * FROM ".DB_NEWSPAPER_TBL;
            
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

    public function save()
    {
        try{
            $con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
            $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

            $sql = "INSERT INTO ".DB_NEWSPAPER_TBL. " (language, name, date_of_receipt, date_published, pages, price, publisher) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";

            $stmt = $con->prepare( $sql );
            $stmt->execute([
                $this->language,
                $this->name,
                $this->date_of_receipt,
                $this->date_published,
                $this->pages,
                $this->price,
                $this->publisher
            ]);
            return $con->lastInsertId();
            $con = null;

        }catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}

?>