<?php

    require_once('./class/class.Fasilitas.php');
    $objFasilitas = new Fasilitas();

    if (isset($_POST['btnSubmit'])) {
        $objFasilitas->jenisFasilitas = $_POST['jenisFasilitas'];

        if (isset($_GET['IDFasilitas'])) {
            $objFasilitas->IDFasilitas = $_GET['IDFasilitas'];
            $objFasilitas->UpdateFasilitas();
        }else{
            $objFasilitas->AddFasilitas();
        }
        echo "<script> alert('$objFasilitas->message');</script>";
        if ($objFasilitas->hasil) {
            echo "<script> window.location = 'dashboardAdmin.php?p=adminListFasilitas' </script>";
        }
    } else if (isset($_GET['IDFasilitas'])) {
        $objFasilitas->IDFasilitas = $_GET['IDFasilitas'];
        $objFasilitas->SelectOneFasilitas();
    }

?>
<div class="container">
    <div class="wrapper">
        <div class="row justify-content-center align-items-center " style="min-height:100vh">
            <div class="col-8">
                <div class="card shadow p-3 mb-5 mt-5 bg-white rounded border-0">
                    <div class="card-body">
                        <h2>Tambah Fasilitas</h2>
                        <p>Tambahkan fasilitas yang belum terdaftar</p>
                            <form action="" autocomplete="off" method="POST"> 
                                <div class="form-group">
                                    <label for="fasilitas">Nama Fasilitas:</label>
                                    <input type="text" class="form-control" id="jenisFasilitas" name="jenisFasilitas" value="<?php echo $objFasilitas->jenisFasilitas; ?>">
                                </div>
                                
                                <input type="submit" name="btnSubmit" class="btn btn-primary btn-block" value="Submit">
                                <a href="dashboardAdmin.php?p=adminListFasilitas" class="btn btn-light btn-block">Cancel</a>
                        </form>          
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
