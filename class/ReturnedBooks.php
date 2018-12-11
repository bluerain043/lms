<?php
class ReturnedBooks{

    private $return_books;
    private $members;
    private $books;
    private $issued_date;
    private $due_date;
    private $return_date;
    private $fine_paid;
    private $cleared_by;


    public function __construct($arData = []) {
        if(isset($arData['return_books']) ) $this->setReturnBooks(stripslashes( strip_tags( $arData['return_books'] ) ));
        if(isset($arData['members']) ) $this->setMembers(stripslashes( strip_tags( $arData['members'] ) ));
        if(isset($arData['books']) ) $this->setBooks(stripslashes( strip_tags( $arData['books'] ) ));
        if(isset($arData['issued_date']) ) $this->setIssuedDate($arData['issued_date']);
        if(isset($arData['due_date']) ) $this->setDueDate($arData['due_date'] );
        $this->setReturnDate(date('Y-m-d'));
        if(isset($arData['fine_paid']) ) $this->setFinePaid(stripslashes( strip_tags( $arData['fine_paid'] ) ));
        if(isset($arData['cleared_by']) ) $this->setClearedBy(stripslashes( strip_tags( $arData['cleared_by'] ) ));
    }

    /** setter **/

    public function setReturnBooks($return_books)
    {
        $this->return_books = $return_books;
    }

    public function setMembers($members)
    {
        $this->members = $members;
    }

    public function setBooks($books)
    {
        $this->books = $books;
    }

    public function setIssuedDate($issued_date)
    {
        $this->issued_date = date('Y-m-d', strtotime($issued_date));
    }

    public function setDueDate($due_date)
    {
        $this->due_date = date('Y-m-d', strtotime($due_date));
    }

    public function setReturnDate($return_date)
    {
        $this->return_date = date('Y-m-d', strtotime($return_date));
    }

    public function setFinePaid($fine_paid)
    {
        $this->fine_paid = $fine_paid;
    }

    public function setClearedBy($cleared_by)
    {
        $this->cleared_by = $cleared_by;
    }

    /** getter **/

    public function getReturnBooks()
    {
        $this->return_books;
    }

    public function getMembers()
    {
        return $this->members;
    }

    public function getBooks()
    {
        return $this->books;
    }

    public function getIssuedDate()
    {
        return $this->issued_date;
    }

    public function getDueDate()
    {
        return $this->due_date;
    }

    public function getReturnDate()
    {
        return $this->return_date;
    }

    public function getFinePaid()
    {
        return $this->fine_paid;
    }

    public function getClearedBy()
    {
        return $this->cleared_by;
    }


    public function postReturnedBooks()
    {
        try{
            $con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
            $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

            $sql = "INSERT INTO ".DB_RETURN_BOOK_TBL. " (members, books, issued_date, due_date, return_date, fine_paid, cleared_by) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";

            $stmt = $con->prepare( $sql );
            $stmt->execute([
                $this->getMembers(),
                $this->getBooks(),
                $this->getIssuedDate(),
                $this->getDueDate(),
                $this->getReturnDate(),
                $this->getFinePaid(),
                $this->getClearedBy()
            ]);
            return $con->lastInsertId();
            $con = null;

        }catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
