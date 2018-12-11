<?php

//require __DIR__.'/Books.php';
require __DIR__.'/Members.php';



class BookIssued extends Books{

    private $book_issued;
    private $due_date;
    private $issued_by;
    private $issued_date;
    private $members;


    /*** declare setters ***/

    public function setBookIssued($book_issued){
        $this->book_issued = $book_issued;
    }
    public function setDueDate($due_date){
        $this->due_date = date('Y-m-d', strtotime($due_date));
    }
    public function setIssuedBy($issued_by){
        $this->issued_by = $issued_by;
    }
    public function setIssuedDate($issued_date){
        $this->issued_date = date('Y-m-d', strtotime($issued_date));
    }
    public function setMembers($members)
    {
        $this->members = $members;
    }

    /** declare getters ***/

    public function getBookIssued(){
        return $this->book_issued;
    }
    public function getDueDate(){
        return $this->due_date;
    }
    public function getIssuedBy(){
        return $this->issued_by;
    }
    public function getIssuedDate(){
        return $this->issued_date;
    }
    public function getMembers()
    {
        return $this->members;
    }


    public static function currentlyLoanBooks($member)
    {
        try{
            $con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
            $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

            $sql = "SELECT * FROM ".DB_BOOK_ISSUED_TBL. " WHERE members =".$member;

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

    public function postIssuedBooks($params){
        try{
            $con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
            $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

            if(isset($params['due_date']) )  $this->setDueDate($params['due_date']);
            if(isset($params['issued_by']) ) $this->setIssuedBy($params['issued_by']);
            if(isset($params['members']) ) $this->setMembers($params['members']);
            if(isset($arData['isbn_no']) ) $this->setIsbnNo(stripslashes( strip_tags( $arData['isbn_no'] ) ));
            $this->setIssuedDate(date('Y-m-d'));

            /** check if member is banned from borrowing a book  **/
            if(Members::checkIsBanned($this->getMembers())){
                return "Selected member is banned from loaning a book";
                exit;
            }
            /** check if member is currently on hold of 5 or more books **/
            if(count(BookIssued::currentlyLoanBooks($this->getMembers())) >= 5){
                return "Selected member exceed maximum book allowed to loaned";
                exit;
            }


            $sql = "SELECT books.* FROM ".DB_BOOK_TBL. " WHERE books.isbn_no = '".$this->getIsbnNo()."'  AND status <> ".Books::BOOK_STAT_ISSUED. " LIMIT 1";
            $stmt = $con->prepare( $sql );
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $current_date = date('Y-m-d');
                $book = $stmt->fetch(PDO::FETCH_ASSOC);

                $stmt = $con->prepare("INSERT INTO ".DB_BOOK_ISSUED_TBL. " (members, books, isbn_no, issued_date, due_date, status, issued_by) 
                        VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([
                    $this->getMembers(),
                    $book['books'],
                    $this->getIsbnNo(),
                    $current_date,
                    $this->getDueDate(),
                    Books::BOOK_STAT_ISSUED,
                    $this->getIssuedBy()
                ]);
                $insID = $con->lastInsertId();
                if($insID){
                    //Change Book status
                    $stmt = $con->prepare("UPDATE ".DB_BOOK_TBL. " SET status=? WHERE books=?");
                    $stmt->execute([
                        Books::BOOK_STAT_ISSUED,
                        $book['books']
                    ]);
                    return "success";
                }


            }else return 'failed';
            $con = null;

        }catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function getBookIssuedByIsbn($isbn)
    {
        try{
            $con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
            $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

            $sql = "SELECT book_issued.*, members.* FROM ".DB_BOOK_ISSUED_TBL. " INNER JOIN members WHERE book_issued.members = members.members 
                AND book_issued.isbn_no = '".$isbn."'";

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

    public static function updateStatus($book, $status = null)
    {
        try{
            $con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
            $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

            $stmt = $con->prepare("UPDATE ".DB_BOOK_ISSUED_TBL. " SET status=? WHERE books=?");
            return $stmt->execute([
                $status,
                $book
            ]);

            $con = null;

        }catch (PDOException $e) {
            return $e->getMessage();
        }

    }


}