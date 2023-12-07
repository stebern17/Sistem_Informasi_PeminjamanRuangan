<?php

    require_once('./class/class.Prodi.php');

    if(isset($_GET['IDProdi'])){
        $objProdi = new Prodi(); 
        $objProdi->IDProdi = $_GET['IDProdi'];
        $objProdi->DeleteProdi();

        echo "<script> alert('$objProdi->message'); </script>";
        echo "<script> window.location = 'dashboardAdmin.php?p=adminListProdi' </script>";
    } else{
        echo '<script> window.history.back() </script>';
    }

?>