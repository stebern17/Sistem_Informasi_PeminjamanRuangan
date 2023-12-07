<div class="container">
    <div class="wrapper">
        <div class="Title"> 
            <div class="navbar ">
                <h2><i class="fas fa-university"></i> List Prodi</h2>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                    <?php
                        if ($_SESSION["role"] == 'Admin') {
                         echo '<a class="btn btn-primary mr-2"  href="dashboardAdmin.php?p=tambahProdi" role="button"><i class="fas fa-plus"></i> Prodi</a>';
                        }
                    ?>
                    </li>
                </ul>
            </div>
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">ID Prodi</th>
                        <th scope="col">Nama Prodi</th>
                        <th scope="col">Kepala Prodi</th>
                        <?php
                            if ($_SESSION["role"] == 'Admin') { 
                                echo '<th scope="col">Action</th>';
                            }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        require_once('./class/class.Prodi.php');
                        $objProdi = new Prodi();
                        $arrayResultProdi = $objProdi->SelectAllProdi();

                        $no = 1;
                        if (count($arrayResultProdi) === 0) {
                            echo '<tr><td colspan="3" style="text-align: center;">Tidak ada data!</td></tr>';
                        }else {
                            foreach($arrayResultProdi as $dataProdi){
                                echo '<tr>';
                                echo '<td>'.$no.'</td>';
                                echo '<td>'.$dataProdi->IDProdi.'</td>';
                                echo '<td>'.$dataProdi->namaProdi.'</td>';
                                echo '<td>'.$dataProdi->kaprodi.'</td>';
                                if ($_SESSION["role"] == 'Admin') { 
                                echo '<td><a class="btn btn-warning" href="dashboardAdmin.php?p=tambahProdi&IDProdi='.$dataProdi->IDProdi.'"><i class="fas fa-edit"></i> Edit</a> <a class="btn btn-danger" href="dashboardAdmin.php?p=deleteProdi&IDProdi='.$dataProdi->IDProdi.'" onclick="return confirm(\'Apakah anda yakin ingin mengahapus?\')"><i class="fas fa-trash"></i> Delete</a></td>';
                                }
                                echo '</tr>';
                                $no++;
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>            