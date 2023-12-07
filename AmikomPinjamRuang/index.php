<?php
    if (!isset($_SESSION)) {
        session_start();
    }
    if(isset($_SESSION["role"])){		
        if($_SESSION["role"] == 'Mahasiswa')
            echo '<script>window.location = "dashboardMahasiswa.php";</script>';
        else if($_SESSION["role"] == 'Dosen')
            echo '<script>window.location = "dashboardMahasiswa.php";</script>';
        else if($_SESSION["role"] == 'Admin')
            echo '<script>window.location = "dashboardAdmin.php";</script>';
    }
    require "inc.koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Amikom Pinjam Ruang</title>

    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
    <link rel="icon" href="favicon.ico">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>  
</head>
    <body>
        <nav class="navbar navbar-expand-sm navbar-light bg-white text-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <img src="RBSLogo.png" width="10%" alt="LogoAmikom">
                    <span style="font-family: sans-serif; font-size: 30px; color: #555555; margin-left: 5px; font-weight: bold;">Amikom Pinjam Ruang</span>
                </a>
            </div>
        </nav>
    

        <main class="container-fluid bg-light pb-5">       
            <?php
                $pages_dir = 'pages';
                if(!empty($_GET['p'])){
                    $pages = scandir($pages_dir, 0);
                    unset($pages[0], $pages[1]);

                    $p = $_GET['p'];
                    if(in_array($p.'.php', $pages)){
                            include($pages_dir.'/'.$p.'.php');
                    } else {
                        echo '<div class="container">';
                        echo '<h1></br>4😕4</h1>';
                        echo '<h2>Halaman yang kamu cari ga ada!</h2>';
                        echo '</br>';
                        echo '<a href="index.php">&larr; Go Home</a>';
                        echo '</div>';
                    }
                } else {
                    include($pages_dir.'/login.php');
                }
            ?>    
        </main>
        
        <footer class="container-fluid bg-white border-top">
            <div class="container footer">
                <small>&copy; Copyright 2023, Amikom Pinjam Ruang. <a href="https://www.amikom.ac.id"> Amikom Yogyakarta </a</small>
            </div>
        </footer>
    </body>
</html>