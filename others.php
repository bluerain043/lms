<?php

public function postIssuedBooks_OLD(){
    try{
        $con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );


        $sql = "SELECT books.* FROM ".DB_BOOK_TBL. " WHERE books.isbn_no = '$this->isbn_no'  AND status <> ".Books::BOOK_STAT_ISSUED. " LIMIT 1";
        $stmt = $con->prepare( $sql );
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $current_date = date('Y-m-d');
            $book = $stmt->fetch(PDO::FETCH_ASSOC);

            $stmt = $con->prepare("INSERT INTO ".DB_BOOK_ISSUED_TBL. " (members, books, isbn_no, issued_date, due_date, status, issued_by) 
                        VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([
                $this->members,
                $book['books'],
                $this->isbn_no,
                $current_date,
                $this->due_date,
                Books::BOOK_STAT_ISSUED,
                $this->issued_by
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

public function postIssuedBooks2($params){
    try{
        $con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

        $bookIssued = new BookIssued();
        if(isset($params['due_date']) )  $bookIssued->setDueDate($params['due_date']);
        if(isset($params['issued_by']) ) $bookIssued->setIssuedBy($params['issued_by']);
        if(isset($params['members']) ) $bookIssued->setMembers($params['members']);
        //if(isset($params['return_date']) ) $bookIssued->setReturnDate($params['return_date']);
        $bookIssued->setIssuedDate(date('Y-m-d'));

        /** check if member is banned from borrowing a book  **/
        if(Members::checkIsBanned($bookIssued->getMembers())){
            return "Selected member is banned from loaning a book";
            exit;
        }
        /** check if member is currently on hold of 5 or more books **/
        if(count(BookIssued::currentlyLoanBooks($bookIssued->getMembers())) >= 5){
            return "Selected member exceed maximum book allowed to loaned";
            exit;
        }


        $sql = "SELECT books.* FROM ".DB_BOOK_TBL. " WHERE books.isbn_no = '$this->isbn_no'  AND status <> ".Books::BOOK_STAT_ISSUED. " LIMIT 1";
        $stmt = $con->prepare( $sql );
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $current_date = date('Y-m-d');
            $book = $stmt->fetch(PDO::FETCH_ASSOC);

            $stmt = $con->prepare("INSERT INTO ".DB_BOOK_ISSUED_TBL. " (members, books, isbn_no, issued_date, due_date, status, issued_by) 
                        VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([
                $bookIssued->getMembers(),
                $book['books'],
                $this->isbn_no,
                $current_date,
                $bookIssued->getDueDate(),
                Books::BOOK_STAT_ISSUED,
                $bookIssued->getIssuedBy()
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