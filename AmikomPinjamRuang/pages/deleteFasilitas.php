<?php

    require_once('./class/class.Fasilitas.php');

    if(isset($_GET['IDFasilitas'])){
        $objFasilitas = new Fasilitas(); 
        $objFasilitas->IDFasilitas = $_GET['IDFasilitas'];
        $objFasilitas->DeleteFasilitas();

        echo "<script> alert('$objFasilitas->message'); </script>";
        echo "<script> window.location = 'dashboardAdmin.php?p=adminListFasilitas' </script>";
    } else{
        echo '<script> window.history.back() </script>';
    }

?>