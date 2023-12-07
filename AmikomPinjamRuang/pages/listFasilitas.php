<div class="container">
    <div class="wrapper">
        <div class="Title"> 
            <div class="navbar ">
                <h2><i class="fas fa-clipboard-list"></i> List Fasilitas</h2>
            </div>
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Nama Fasilitas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        require_once('./class/class.Fasilitas.php');
                        $objFasilitas = new Fasilitas();
                        $arrayResult = $objFasilitas->SelectAllFasilitas();
                        
                        $no = 1;
                        if (count($arrayResult) === 0) {
                            echo '<tr><td colspan="2" style="text-align: center;">Tidak ada data!</td></tr>';
                        }else {
                            foreach($arrayResult as $dataFasilitas){
                                echo '<tr>';
                                echo '<td>'.$no.'</td>';
                                echo '<td>'.$dataFasilitas->jenisFasilitas.'</td>';
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