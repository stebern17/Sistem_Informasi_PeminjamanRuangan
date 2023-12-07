<?php

    require_once('./class/class.Ruangan.php');
    require_once('./class/class.Fasilitas.php');
    $objRuangan = new Ruangan();
    $objFasilitas = new Fasilitas();
    if(isset($_POST['btnSubmit'])){
        
        $objRuangan->namaRuangan = $_POST['namaRuangan'];
        $objRuangan->lantai = $_POST['lantai'];
        $objRuangan->kapasitas = $_POST['kapasitas'];
        $objRuangan->fotoRuangan = $_FILES['fotoRuangan']['name'];
        $objRuangan->UserID = $_SESSION['UserID'];
        $lokasi_file    = $_FILES['fotoRuangan']['tmp_name'];
        $tipe_file      = $_FILES['fotoRuangan']['type'];
        $folder         = './upload/';


        if(isset($_GET['IDRuangan'])){
            $objRuangan->IDRuangan = $_GET['IDRuangan'];
            $objRuangan->UpdateRuangan();
        }else{
            $objRuangan->AddRuangan();
            
        }

        
        // if ($tipe_file != "image/jpeg" AND $tipe_file != "image/png") {
        //     echo "<script>alert('Tipe file salah atau tidak ada file yang dipilih, pilih file yang lain');</script>";
        //     echo "<script>window.location = 'index.php?p=tambahRuangan';</script>";
        // }
        // else{
            $isSuccessUpload = move_uploaded_file($lokasi_file, $folder.$objRuangan->fotoRuangan);
        //     if($isSuccessUpload){
        //         echo "<script>alert('Data Berhasil Ditambahkan dan Nama File : $objRuangan->fotoRuangan sukses diupload');</script>";
        //         echo "<script>window.location = 'index.php?p=pilihRuangan';</script>";
        //     }
        // }
        echo "<script> alert('$objRuangan->message'); </script>";
        if($objRuangan->hasil){
            echo '<script> window.location = "dashboardAdmin.php?p=adminListRuangan"; </script>';
        }

        
    } else if(isset($_GET['IDRuangan'])){
        $objRuangan->IDRuangan = $_GET['IDRuangan'];
        $objRuangan->SelectOneRuangan();
    }
?>
<div class="container">
    <div class="wrapper">
        <div class="row justify-content-center align-items-center " style="height:100%">
            <div class="col-6">
                <div class="card shadow p-3 mb-5 mt-5 bg-white rounded border-0">
                    <div class="card-body">
                        <h2>Tambah Ruangan</h2>
                        <p>Tambahkan ruangan yang belum terdaftar</p> 
                        <form action="" autocomplete="off" method="POST" enctype="multipart/form-data"> 
                            <?php
                            // if($objRuangan->fotoRuangan != null)
                            //     echo '<img class="img-rounded img-responsive" src="upload/'.$objRuangan->fotoRuangan.'">';	
                            // else
                            //     echo '<img class="img-rounded img-responsive" src="upload/default.png">';	
                            ?>

                            <div class="form-group">
                                <label for="namaRuangan">Nama Ruangan:</label>
                                 <input type="text" class="form-control" name="namaRuangan" value="<?php echo $objRuangan->namaRuangan; ?>">
                            </div>

                            <div class="form-group">
                                <label for="lantai">Lantai:</label>
                                <select class="form-control" name="lantai">
                                    <!-- <option value=02>02</option>
                                    <option value=18>18</option>
                                    <option value=19>19</option> -->
                                    <?php   
                                            $floor = ['G2 l1', 'G2 l2', 'G2 l3', 'G2 l4', 'G3 l1', 'G3 l2', 'G3 l3', 'G3 l4', 'G4 l1', 'G4 l2', 'G4 l3', 'G4 l4', 'G5 l1', 'G5 l2', 'G5 l3', 'G5 l4', 'G7 l1', 'G7 l2', 'G7 l3', 'G7 l4'];
                                            foreach($floor as $lantai){
                                                if ($objRuangan->lantai == $lantai ) {
                                                    echo '<option selected value='.$lantai.'>'.$lantai.'</option>';
                                                } else {
                                                    echo '<option value='.$lantai.'>'.$lantai.'</option>';
                                                }
                                                    
                                            }
                                        ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="kapasitas">Kapasitas:</label>
                                <input type="number" class="form-control" name="kapasitas" value="<?php echo $objRuangan->kapasitas; ?>">
                            </div>
                            
                            <div class="form-group">
                                <label for="fotoRuangan">Foto Ruangan:</label>
                                <input type="file" class="form-control-file" name="fotoRuangan" >
                            </div>
                            

                            <input type="submit" name="btnSubmit" class="btn btn-primary btn-block" value="Save">
                            <a href="dashboardAdmin.php?p=adminListRuangan" class="btn btn-light btn-block">Cancel</a>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>