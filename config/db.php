<?php
    //set off all error for security purposes
	error_reporting(E_ALL);

	//define some contstant
    define( "DB_DSN", "mysql:host=localhost;dbname=lms" );
    define( "DB_HOST", "localhost" );
    define( "DB_USERNAME", "root" );
    define( "DB_PASSWORD", "" );
    define( "DB_USER_TBL", "users" );
    define( "DB_BOOK_TBL", "books" );
    define( "DB_TYPES_TBL", "types" );
    define( "DB_MEMBERS_TBL", "members" );
    define( "DB_NEWSPAPER_TBL", "newspapers" );
    define( "DB_MAGAZINE_TBL", "magazines" );
    define( "DB_BOOK_ISSUED_TBL", "book_issued" );
    define( "DB_COMMUNITY_TBL", "community" );

	//define( "DB_TABLE", "demo_myWoyster_login" );
	define( "CLS_PATH", "class" );
	
?>