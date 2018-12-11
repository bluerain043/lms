<?php

session_start();
session_unset();

if(isset($_GET['admin']) && $_GET['admin'] == 'yes'){
    print_r('<script>window.location="./index.php"</script>');
}else{
    print_r('<script>window.location="./"</script>');
}

exit();
?>