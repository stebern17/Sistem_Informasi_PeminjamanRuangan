<?php

    require_once('./class/class.Peminjaman.php');

    if(isset($_GET['IDPeminjaman'])){
        $objPeminjaman = new Peminjaman_Ruangan(); 
        $objPeminjaman->IDPeminjaman = $_GET['IDPeminjaman'];
        $objPeminjaman->BatalkanPeminjaman();

        echo "<script> alert('$objPeminjaman->message'); </script>";
        echo "<script> window.location = 'dashboardAdmin.php?p=adminListPeminjaman' </script>";
    } else{
        echo '<script> window.history.back() </script>';
    }

?>