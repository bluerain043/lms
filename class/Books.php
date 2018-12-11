<?php


class Books{


    const BOOK_STAT_AVAILABLE = 0;
    const BOOK_STAT_ISSUED = 1;
    const BOOK_STAT_RETURNED = 2;
    const BOOK_STAT_OVERDUE = 3;

    private $books;
    private $isbn_no;
    private $book_title;
    private $book_type;
    private $author_name;
    private $purchase_date;
    private $edition;
    private $price;
    private $pages;
    private $publisher;


    public function __construct( $arData = [] ) {

        if(isset($arData['books']) ) $this->books = stripslashes( strip_tags( $arData['books'] ) );
        if(isset($arData['isbn_no']) ) $this->isbn_no = stripslashes( strip_tags( $arData['isbn_no'] ) );
        if(isset($arData['book_title']) ) $this->book_title = stripslashes( strip_tags( $arData['book_title'] ) );
        if(isset($arData['book_type']) ) $this->book_type = stripslashes( strip_tags( $arData['book_type'] ) );
        if(isset($arData['author_name']) ) $this->author_name = stripslashes( strip_tags( $arData['author_name'] ) );
        if(isset($arData['purchase_date']) ) $this->purchase_date = stripslashes( strip_tags( $arData['purchase_date'] ) );
        if(isset($arData['edition']) ) $this->edition = stripslashes( strip_tags( $arData['edition'] ) );
        if(isset($arData['price']) ) $this->price = stripslashes( strip_tags( $arData['price'] ) );
        if(isset($arData['pages']) ) $this->pages = stripslashes( strip_tags( $arData['pages'] ) );
        if(isset($arData['publisher']) ) $this->publisher = stripslashes( strip_tags( $arData['publisher'] ) );

   }

    public function storeFormValues( $params ) {
        $this->__construct( $params );
    }

    /** setter **/
    public function setBooks($books)
    {
        $this->books = $books;
    }

    public function setIsbnNo($isbn_no)
    {
        $this->isbn_no = $isbn_no;
    }

    public function setBookTitle($book_title)
    {
        $this->book_title = $book_title;
    }

    public function setBookType($book_type)
    {
        $this->book_type = $book_type;
    }

    public function setAuthorName($author_name)
    {
     $this->author_name = $author_name;
    }

    public function setPurchaseDate($purchase_date)
    {
       $this->purchase_date = date('Y-m-d', strtotime($purchase_date));
    }

    public function setEdition($edition)
    {
        $this->edition = $edition;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function setPages($pages)
    {
        $this->pages = $pages;
    }

    public function setPublisher($publisher)
    {
        $this->publisher = $publisher;
    }


    /** getters **/

    public function getBooks()
    {
        return $this->books;
    }

    public function getIsbnNo()
    {
        return $this->isbn_no;
    }

    public function getBookTitle()
    {
        return $this->book_title;
    }

    public function getBookType()
    {
        return $this->book_type;
    }

    public function getAuthorName()
    {
        return $this->author_nameme;
    }

    public function getPurchaseDate()
    {
        return $this->purchase_dated;
    }

    public function getEdition()
    {
        return $this->edition;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getPages()
    {
        return $this->pages;
    }

    public function getPublisher()
    {
        return $this->publisher;
    }



    public static function getAllAvailableBooks(){
        try{
            $con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
            $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

            $sql = "SELECT books.*, types.Name as booktype FROM ".DB_BOOK_TBL. " JOIN ".DB_TYPES_TBL." WHERE books.book_type = types.id 
                    AND books.status =".Books::BOOK_STAT_AVAILABLE;

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

    public static function getBooksByIsbn($isbn){
        try{
            $con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
            $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

            //$sql = "SELECT books.*, types.Name as booktype FROM ".DB_BOOK_TBL. " JOIN ".DB_TYPES_TBL." WHERE books.book_type = types.id AND books.isbn_no = '".$isbn."'";
            $sql= "SELECT b.*, t.Name as booktype FROM ".DB_BOOK_TBL. " b JOIN ".DB_TYPES_TBL." t ON b.book_type = t.id WHERE b.isbn_no = '".$isbn."'";

            $stmt = $con->prepare( $sql );
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return $stmt->fetch(PDO::FETCH_ASSOC);

            }else return null;
            $con = null;

        }catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function getIssuedBooksByIsbn($isbn)
    {
        try{
            $con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
            $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

            $sql = "SELECT b.*, m.*, bk.book_issued, bk.due_date, bk.issued_date, bk.members, t.Name as booktype, c.name as community_name
                    FROM ".DB_BOOK_TBL. " b 
                    INNER JOIN ".DB_BOOK_ISSUED_TBL." bk ON b.isbn_no = bk.isbn_no 
                    INNER JOIN ".DB_MEMBERS_TBL." m ON bk.members = m.members
                    INNER JOIN ".DB_COMMUNITY_TBL." c ON m.community = c.community
                    INNER JOIN ".DB_TYPES_TBL." t ON b.book_type = t.id
                    WHERE b.isbn_no = '".$isbn."'";

            $stmt = $con->prepare( $sql );
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return $stmt->fetch(PDO::FETCH_ASSOC);

            }else return null;
            $con = null;

        }catch (PDOException $e) {
            return $e->getMessage();
        }
    }


    public function postAddBooks(){
        try{
            $con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
            $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

            $sql = "SELECT * FROM ".DB_BOOK_TBL." WHERE isbn_no = '$this->isbn_no' ";
            $stmt = $con->prepare( $sql );
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return "Duplicate book isbn entry. Please try again";

            }else{

                $stmt = $con->prepare("INSERT INTO ".DB_BOOK_TBL. " (isbn_no, book_title, book_type, author_name, purchase_date, edition, price, pages, publisher, status) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([
                    $this->isbn_no,
                    $this->book_title,
                    $this->book_type,
                    $this->author_name,
                    $this->purchase_date,
                    $this->edition,
                    $this->price,
                    $this->pages,
                    $this->publisher,
                    Books::BOOK_STAT_AVAILABLE
                ]);
                if ($stmt->rowCount() > 0) return "success";

            };
            $con = null;

        }catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function getBookByStatus($status = null)
    {
        try{
            $con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
            $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

            $sql = "SELECT books.*, types.name as booktype FROM ".DB_BOOK_TBL. " JOIN ".DB_TYPES_TBL." WHERE books.book_type = types.id ";

            if($status) $sql .= "AND books.status =".$status;

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