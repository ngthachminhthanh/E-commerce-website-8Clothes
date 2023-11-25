<?php
    session_start();

    if(isset($_SESSION['valid'])){
        if(isset($_POST['action']) && $_POST['action'] === 'click'){
            echo "checkout.php";
        }
    } else {
        echo "login.php";
    }
?>