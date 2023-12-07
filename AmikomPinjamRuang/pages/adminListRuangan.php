<div class="container">
    <div class="wrapper">
        <div class="Title">           
            <div class="navbar">
                <h2><i class="fas fa-door-open"></i> List Ruangan</h2>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                    <?php
                        if ($_SESSION["role"] == 'Admin') {
                        echo '<a class="btn btn-primary mr-2"  href="dashboardAdmin.php?p=tambahRuangan" role="button"><i class="fas fa-plus"></i> Ruangan</a>';
                        }
                    ?>
                    </li>
                </ul>
            </div>
            
            <!-- Daftar Ruangan Yang Bisa Dipinjam -->
            <div class="row row-cols-1 row-cols-md-3 m-0">
                <?php
                    require_once('./class/class.Ruangan.php');
                    $objRuangan = new Ruangan();
                    $arrayResult = $objRuangan->SelectAllRuangan();

                    if(count($arrayResult) == 0){
                        echo '<h3>Tidak ada data!</h3>';
                    } else{
                        $objRuangan->IDRuangan;
                        foreach ($arrayResult as $dataRuangan) {
                            echo '<div class="col-mb-4">';
                            echo '<div class="card cardRuangan mr-5">';
                            echo '<img src="upload/'.$dataRuangan->fotoRuangan.'" class="card-img-top" alt="'.$dataRuangan->namaRuangan.'">';
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title">'.$dataRuangan->namaRuangan.'</h5>';
                            echo '<ul>';
                            echo '<li>Lantai: '.$dataRuangan->lantai.'</li>';
                            echo '<li>Kapasitas: '.$dataRuangan->kapasitas.'</li>';
                            echo '</ul>';
                            echo '<a class="btn btn-primary btn-block mb-1" href="dashboardAdmin.php?p=formPinjam" role="button"><i class="fas fa-door-open"></i> Book</a>';
                            if ($_SESSION["role"] == 'Admin') { 
                            echo '<a class="btn btn-warning btn-block mb-1" href="dashboardAdmin.php?p=tambahRuangan&IDRuangan='.$dataRuangan->IDRuangan.'"><i class="fas fa-edit"></i> Edit</a>';
                            echo '<a class="btn btn-danger btn-block mb-1" href="dashboardAdmin.php?p=deleteRuangan&IDRuangan='.$dataRuangan->IDRuangan.'" onclick="return confirm(\'Apakah anda yakin ingin mengahapus?\')"><i class="fas fa-trash"></i> Delete</a>';
                            }
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</div>