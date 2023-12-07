<div class="container">
    <div class="wrapper">
        <div class="Title"> 
            <div class="navbar ">
                <h2><i class="fas fa-university"></i> List Prodi</h2>
            </div>
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Nama Prodi</th>
                        <th scope="col">Kepala Prodi</th>
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
                                echo '<td>'.$dataProdi->namaProdi.'</td>';
                                echo '<td>'.$dataProdi->kaprodi.'</td>';
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