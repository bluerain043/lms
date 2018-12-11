<?php

session_start();
unset($_SESSION);
session_unset();
session_destroy();


if(isset($_GET['admin']) && $_GET['admin'] == 'yes'){
    print_r('<script>window.location="./index.php"</script>');
}else{
    print_r('<script>window.location="./"</script>');
}

exit();
?>