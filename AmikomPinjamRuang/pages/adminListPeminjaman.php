<div class="container">
    <div class="wrapper">
        <div class="Title"> 
            <div class="navbar ">
                <h2><i class="fas fa-calendar-alt"></i> Peminjaman</h2>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                    <a class="btn btn-info mr-2"  href="pages/report_peminjaman.php" target=_blank role="button"><i class="fas fa-file-download"></i> Download</a>
                    </li>
                </ul>
            </div>
            <!-- Daftar Peminjaman Ruangan-->
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Peminjam</th>
                        <th scope="col">Ruangan</th>
                        <th scope="col">Tanggal Pinjam</th>
                        <th scope="col">Tanggal Selesai</th>
                        <th scope="col">Jam Pinjam</th>
                        <th scope="col">Jam Selesai</th>
                        <th scope="col">Persetujuan</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    require_once('./class/class.Peminjaman.php');
                    $objPeminjaman = new Peminjaman_Ruangan();
                    $arrayPeminjaman = $objPeminjaman->SelectAllPeminjaman();

                    if(count($arrayPeminjaman) == 0){
                        echo '<tr><td colspan="8" style="text-align: center;"><i class="fas fa-calendar-times"></i>Tidak ada data!</td></tr>';
                    } else{
                        $objPeminjaman->IDPeminjaman;
                        foreach ($arrayPeminjaman as $dataPeminjaman) {
                            echo '<tr>';
                            echo '<td>'.$dataPeminjaman->user->nama.'</td>';
                            echo '<td>'.$dataPeminjaman->ruangan->namaRuangan.'</td>';
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
                            echo '<td>';
                                if ($dataPeminjaman->persetujuan === 'Disetujui') {
                                    echo '<a class="btn btn-danger" href="dashboardAdmin.php?p=peminjamanUndone&IDPeminjaman='.$dataPeminjaman->IDPeminjaman.'"><i class="fas fa-times"></i> Batalkan</a>';
                                } elseif ($dataPeminjaman->persetujuan === 'Tidak disetujui') {
                                    echo '<a class="btn btn-success" href="dashboardAdmin.php?p=peminjamanApproval&IDPeminjaman='.$dataPeminjaman->IDPeminjaman.'"><i class="fas fa-check"></i> Setujui</a>';
                                } elseif($dataPeminjaman->persetujuan === 'Persetujuan 1'){
                                    if ($_SESSION["role"] == 'Admin') {
                                        echo '<a class="btn btn-success" href="dashboardAdmin.php?p=peminjamanApproval&IDPeminjaman='.$dataPeminjaman->IDPeminjaman.'"><i class="fas fa-check"></i> Setujui</a>';
                                        echo '<a class="btn btn-danger" href="dashboardAdmin.php?p=peminjamanRejection&IDPeminjaman='.$dataPeminjaman->IDPeminjaman.'"><i class="fas fa-times"></i> Tolak</a>';
                                    } elseif ($_SESSION["role"] == 'Kadiv') {
                                        echo '<a class="btn btn-success disabled" ><i class="fas fa-check"></i> Setujui</a>';
                                        echo '<a class="btn btn-danger" href="dashboardAdmin.php?p=peminjamanUndone&IDPeminjaman='.$dataPeminjaman->IDPeminjaman.'"><i class="fas fa-times"></i> Batalkan</a>';
                                    }
                                } elseif ($dataPeminjaman->persetujuan === 'Belum disetujui') {
                                    if ($_SESSION["role"] == 'Admin') {
                                        echo '<a class="btn btn-success disabled" href="#"><i class="fas fa-check"></i> Setujui</a>';
                                        echo '<a class="btn btn-danger disabled" href="#"><i class="fas fa-times"></i> Tolak</a>';
                                    } elseif ($_SESSION["role"] == 'Kadiv') {
                                        echo '<a class="btn btn-success" href="dashboardAdmin.php?p=peminjamanApprovalKadiv&IDPeminjaman='.$dataPeminjaman->IDPeminjaman.'"><i class="fas fa-check"></i> Setujui</a>';
                                        echo '<a class="btn btn-danger" href="dashboardAdmin.php?p=peminjamanRejection&IDPeminjaman='.$dataPeminjaman->IDPeminjaman.'"><i class="fas fa-times"></i> Tolak</a>';
                                    }
                                }
                            echo '</td>';
                            echo '</tr>';
                        }
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>  