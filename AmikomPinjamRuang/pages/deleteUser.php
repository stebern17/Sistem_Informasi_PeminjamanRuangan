<?php

    require_once('./class/class.Register.php');

    if(isset($_GET['UserID'])){
        $objRegister = new Register(); 
        $objRegister->UserID = $_GET['UserID'];
        $objRegister->DeleteMember();

        echo "<script> alert('$objRegister->message'); </script>";
        echo "<script> window.location = 'dashboardAdmin.php?p=adminListUser' </script>";
    } else{
        echo '<script> window.history.back() </script>';
    }

?>