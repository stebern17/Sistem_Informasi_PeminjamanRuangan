<div class="container">
    <div class="wrapper">
        
        <div class="Title">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Welcome to Room Booking System, <?php echo '<strong>'.$_SESSION["nama"].'</strong>' ?>. You log in as <?php echo $_SESSION["role"] ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="navbar">
                <h2><i class="fas fa-calendar-alt"></i> Peminjaman </h2>
            </div>
            <!-- Daftar Ruangan Yang Bisa Dipinjam -->
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Ruangan</th>
                        <th scope="col">Tanggal Pinjam</th>
                        <th scope="col">Tanggal Selesai</th>
                        <th scope="col">Jam Pinjam</th>
                        <th scope="col">Jam Selesai</th>
                        <th scope="col">Persetujuan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        require_once('./class/class.Peminjaman.php');
                        $objPeminjaman = new Peminjaman_Ruangan();
                        $arrayPeminjaman = $objPeminjaman->SelectAllPeminjamanUser();

                        if(count($arrayPeminjaman) == 0){
                            echo '<tr><td colspan="6" class="justify-content-center align-items-center"><i class="fas fa-calendar-times"></i>Tidak ada data!</td></tr>';
                        } else{
                            foreach ($arrayPeminjaman as $dataPeminjaman) {
                                if ($_SESSION["UserID"] == $dataPeminjaman->UserID) {
                                    echo '<tr>';
                                    echo '<td style="white-space: nowrap; overflow: hidden; width: 70px; text-overflow: ellipsis; table-layout: fixed">'.$dataPeminjaman->ruangan->namaRuangan.'</td>';
                                    echo '<td>'.$dataPeminjaman->tglPinjam.'</td>';
                                    echo '<td>'.$dataPeminjaman->tglSelesai.'</td>';
                                    echo '<td>'.$dataPeminjaman->jamPinjam.'</td>';
                                    echo '<td>'.$dataPeminjaman->jamSelesai.'</td>';
                                    echo '<td ';
                                    if ($dataPeminjaman->persetujuan === 'Disetujui') {
                                        echo 'class="alert alert-success" role="alert"><strong>'.$dataPeminjaman->persetujuan;
                                    } elseif ($dataPeminjaman->persetujuan === 'Tidak disetujui') {
                                        echo 'class="alert alert-danger" role="alert"><strong>'.$dataPeminjaman->persetujuan;
                                    } else {
                                        echo 'class="alert alert-warning" role="alert"><strong>'.$dataPeminjaman->persetujuan;
                                    }
                                    echo '</strong></td>';
                                    echo '</tr>';
                                } else {
                                    echo '<tr><td colspan="6" style="text-align: center;"> Kamu belum meminjam ruangan! </td></tr>';
                                }
                                
                            }
                        }
                    ?>
                </tbody>
            </table>

            <div class="navbar">
                <h2><i class="fas fa-door-open"></i> Pilih Ruangan</h2>
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
                            echo '<a class="btn btn-primary btn-block mb-1" href="dashboardMahasiswa.php?p=formPinjam&IDRuangan='.$dataRuangan->IDRuangan.'&namaRuangan='.$dataRuangan->namaRuangan.'" role="button"><i class="fas fa-door-open"></i> Book</a>';
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