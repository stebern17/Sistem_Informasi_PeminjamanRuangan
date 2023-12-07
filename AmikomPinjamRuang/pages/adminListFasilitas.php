<div class="container">
    <div class="wrapper">
        <div class="Title"> 
            <div class="navbar ">
                <h2><i class="fas fa-clipboard-list"></i> List Fasilitas</h2>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                    <?php
                        if ($_SESSION["role"] == 'Admin') {
                            echo '<a class="btn btn-primary mr-2"  href="dashboardAdmin.php?p=tambahFasilitas" role="button"><i class="fas fa-plus"></i> Fasilitas</a>';
                        }
                    ?>
                    </li>
                </ul>
            </div>
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">ID Fasilitas</th>
                        <th scope="col">Nama Fasilitas</th>
                        <?php
                            if ($_SESSION["role"] == 'Admin') { 
                                echo '<th scope="col">Action</th>';
                            }
                            ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        require_once('./class/class.Fasilitas.php');
                        $objFasilitas = new Fasilitas();
                        $arrayResult = $objFasilitas->SelectAllFasilitas();

                        $no = 1;
                        if (count($arrayResult) === 0) {
                            echo '<tr><td colspan="3" style="text-align: center;">Tidak ada data!</td></tr>';
                        }else {
                            foreach($arrayResult as $dataFasilitas){
                                echo '<tr>';
                                echo '<td>'.$no.'</td>';
                                echo '<td>'.$dataFasilitas->IDFasilitas.'</td>';
                                echo '<td>'.$dataFasilitas->jenisFasilitas.'</td>';
                                if ($_SESSION["role"] == 'Admin') { 
                                echo '<td><a class="btn btn-warning" href="dashboardAdmin.php?p=tambahFasilitas&IDFasilitas='.$dataFasilitas->IDFasilitas.'"><i class="fas fa-edit"></i> Edit</a> <a class="btn btn-danger" href="dashboardAdmin.php?p=deleteFasilitas&IDFasilitas='.$dataFasilitas->IDFasilitas.'" onclick="return confirm(\'Apakah anda yakin ingin mengahapus?\')"><i class="fas fa-trash"></i> Delete</a></td>';
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