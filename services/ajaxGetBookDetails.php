<?php
$currDir = dirname(__FILE__);
include_once("../config/db.php");
include_once("../class/Books.php");
include_once("../class/BookIssued.php");
include_once("../class/ReturnedBooks.php");
include_once("../class/Magazines.php");
include_once("../class/Newspapers.php");
include_once("../lib/functions.php");


if(isset($_GET['isbn']) && $_GET['action'] == 'loan'){
    $isbn = stripslashes( strip_tags( $_GET['isbn'] ) );
    $arBooks = Books::getBooksByIsbn($isbn);
    echo json_encode($arBooks);
}

if(isset($_POST['action']) && $_POST['action'] == 'entry'){
    /*$book = new Books();
    $book->storeFormValues($_POST);
    $arResponse = $book->postIssuedBooks($_POST);*/
    $bookIssued = new BookIssued($_POST);
    $arResponse = $bookIssued->postIssuedBooks($_POST);

    echo json_encode($arResponse);
}

if(isset($_POST['action']) && $_POST['action'] == 'addBooks'){
    $book = new Books();
    $book->storeFormValues($_POST);
    $arResponse = $book->postAddBooks();
    echo json_encode($arResponse);
}
if(isset($_GET['isbn']) && $_GET['action'] == 'returned'){
    $isbn = stripslashes( strip_tags( $_GET['isbn'] ) );
    $arResponse = Books::getIssuedBooksByIsbn($isbn);
    if(!is_null($due_date = $arResponse['due_date'])){
        if(($fines = dateDifference($due_date, date('Y-m-d')))> 0){
            $arResponse['days_of_overdue'] = $fines;
            $arResponse['fine_paid'] = sprintf('%0.2f', ($fines * 0.2));
        }
    }
    echo json_encode($arResponse);
}

if(isset($_POST['action']) && $_POST['action'] == 'returnedBooks'){
    $returned = new ReturnedBooks($_POST);
    $arResponse = $returned->postReturnedBooks();
    if($arResponse){
        $update = BookIssued::updateStatus($_POST['books'], 0);
        echo 'Book returned successfully';
    }else{
        echo 'Problem while returning book';
    }

}

if(isset($_POST['action']) && $_POST['action'] == 'addMagazine'){
    $magazine = new Magazines($_POST);
    $bSave = $magazine->save();
    if($bSave > 0){
        redirect('../magazine.php?msg=ok');
    }else{
        redirect('../magazine.php?msg=failed');
    }
}
if(isset($_POST['action']) && $_POST['action'] == 'addNewspaper'){
    $magazine = new Newspapers($_POST);
    $bSave = $magazine->save();
    if($bSave > 0){
        redirect('../newspaper.php?msg=ok');
    }else{
        redirect('../newspaper.php?msg=failed');
    }
}
