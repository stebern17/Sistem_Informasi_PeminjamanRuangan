<?php

    require_once('./class/class.Ruangan.php');

    if(isset($_GET['IDRuangan'])){
        $objRuangan = new Ruangan(); 
        $objRuangan->IDRuangan = $_GET['IDRuangan'];
        $objRuangan->DeleteRuangan();

        echo "<script> alert('$objRuangan->message'); </script>";
        echo "<script> window.location = 'dashboardAdmin.php?p=adminListRuangan' </script>";
    } else{
        echo '<script> window.history.back() </script>';
    }

?>