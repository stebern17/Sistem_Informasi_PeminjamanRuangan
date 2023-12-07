<?php

    require_once('./class/class.Register.php');
    require_once('./class/class.Prodi.php');
    require_once('./class/class.Peminjam.php');

    $objProdi = new Prodi();
    $objRegister = new Register();
    $objPeminjam = new Peminjam();

    $prodiList = $objProdi->SelectAllProdi();

    if(isset($_POST['btnUpdate'])){
        $objRegister->UserID = $_SESSION['UserID'];
        $objRegister->email = $_POST['email'];
        $password = $_POST['pass'];
        $objRegister->password = password_hash($password, PASSWORD_DEFAULT);
        $objRegister->nama = $_POST['fullname'];
        $objRegister->alamat = $_POST['address'];
        $objRegister->role = $_POST['pekerjaan'];
        $objRegister->noTelp = $_POST['noTelp'];
        $objRegister->gender = $_POST['jenisKelamin'];
        $objPeminjam->UserID = $_SESSION['UserID'];
        $objPeminjam->NIM = $_POST['nim'];
        $objPeminjam->NIDN = $_POST['nidn'];
        $objPeminjam->IDProdi = $_POST['prodi'];
        $objRegister->UpdateMember();
        $objPeminjam->UpdatePeminjam();
        
        if($objRegister->hasil){
        echo "<script> alert('$objRegister->message'); </script>";
        echo '<script> window.location = "index.php"; </script>';
        }
    } else if (isset($_GET['UserID'])) {
        $objRegister->UserID = $_GET['UserID'];
        $objPeminjam->UserID = $_GET['UserID'];
        $objRegister->SelectOneMember();
        $objPeminjam->SelectOnePeminjam();
    }
?>
<div class="container">
    <div class="wrapper">
        <div class="row justify-content-center align-items-center " style="height:100%">
        <div class="col-md-9">
		    <div class="card shadow p-3 mb-5 mt-5 bg-white rounded border-0">
		        <div class="card-body">
		            <div class="row">
		                <div class="col-md-12">
		                    <h4><i class="fas fa-user"></i> Your Profile</h4>
		                    <hr>
		                </div>
		            </div>
		            <div class="row">
		                <div class="col-md-12">
                            <form action="" autocomplete="off" method="POST">
                                
                                <!-- Full Name -->
                                <div class="form-group">
                                    <label for="fullName">Full Name</label>
                                    <input type="text" class="form-control" name="fullname" id="fullName" value="<?php echo $objRegister->nama; ?>">
                                </div>

                                <!-- Email -->
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" value="<?php echo $objRegister->email; ?>">
                                </div>

                                <!-- Password -->
                                <div class="form-group">
                                    <label for="pass">Password</label>
                                    <div class="input-group">
                                    <input type="password" class="form-control pwd" id="pass" name="pass" autocomplete="off" value="<?php echo $objRegister->password; ?>">
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary reveal " type="button"><i class="fa fa-eye"></i></button>
                                    </span>          
                                </div>
                                </div>

                                <!-- Pekerjaan/Role -->
                                <div class="form-group" role="tab-list">
                                    <label for="pekerjaan">Pekerjaan</label></br>
                                    <?php
                                            $pekerjaan = array("Mahasiswa", "Dosen", "Umum");
                                            foreach($pekerjaan as $role) {	
                                                if($objRegister->role == $role){
                                                    echo '<div class="custom-control custom-radio custom-control-inline">';
                                                    echo '<input type="radio" id="role'.$role.'" name="pekerjaan" class="custom-control-input" checked value="'.$role.'" data-target="#'.$role.'-content">';					
                                                    echo '<label class="custom-control-label" for="role'.$role.'">'.$role.'</label>';
                                                    echo '</div>';
                                                }else{
                                                    echo '<div class="custom-control custom-radio custom-control-inline">';
                                                    echo '<input type="radio" id="role'.$role.'" name="pekerjaan" class="custom-control-input" value="'.$role.'" data-target="#'.$role.'-content">';					
                                                    echo '<label class="custom-control-label" for="role'.$role.'">'.$role.'</label>';
                                                    echo '</div>';
                                                }
                                            }	
                                        ?>
                                </div>

                                <!-- Tab Input NIM, NIDN, dan Umum -->
                                <div class="tab-content">
                                    <?php
                                        if($objRegister->role == "Mahasiswa"){
                                            echo '<div class="form-group tab-pane active" id="Mahasiswa-content">';
                                            echo '<label for="nim">NIM</label>';
                                            echo '<input type="number" class="form-control" name="nim" id="nim" value="'.$objPeminjam->NIM.'">';
                                            echo '</div>';
                                            echo '<div class="form-group tab-pane" id="Dosen-content">';
                                            echo '<label for="nidn">NIDN</label>';
                                            echo '<input type="number" class="form-control" name="nidn" id="nidn" value="'.$objPeminjam->NIDN.'">';
                                            echo '</div>';
                                            echo '<div id="Umum-content">';
                                            echo '</div>';
                                        } elseif ($objRegister->role == "Dosen") {
                                            echo '<div class="form-group tab-pane" id="Mahasiswa-content">';
                                            echo '<label for="nim">NIM</label>';
                                            echo '<input type="number" class="form-control" name="nim" id="nim" value="'.$objPeminjam->NIM.'">';
                                            echo '</div>';
                                            echo '<div class="form-group tab-pane active" id="Dosen-content">';
                                            echo '<label for="nidn">NIDN</label>';
                                            echo '<input type="number" class="form-control" name="nidn" id="nidn" value="'.$objPeminjam->NIDN.'">';
                                            echo '</div>';
                                            echo '<div id="Umum-content">';
                                            echo '</div>';
                                        }
                                        
                                    ?>
                                </div>

                                <!-- Prodi -->
                                <div class="form-group">
                                    <label for="prodi">Prodi</label>
                                    <select name="prodi" class="form-control" id="prodi">
                                        <?php
                                            foreach($prodiList as $prodi){
                                                if ($objPeminjam->IDProdi == $prodi->IDProdi ) {
                                                    echo '<option selected value="'.$prodi->IDProdi.'">'.$prodi->namaProdi.'</option>';
                                                } else {
                                                    echo '<option value="'.$prodi->IDProdi.'">'.$prodi->namaProdi.'</option>';
                                                }
                                                    
                                            }
                                        ?>
                                    </select>
                                </div>

                                <!-- Alamat -->
                                <div class="form-group">
                                    <label for="address">Alamat</label>
                                    <textarea class="form-control" name="address" id="address" rows="3" style="height:100%"><?php echo $objRegister->alamat; ?></textarea>
                                </div>

                                <!-- Nomer Telepon -->
                                <div class="form-group">
                                    <label for="noTelp">Nomor Telepon</label>
                                    <input type="number" class="form-control" name="noTelp" id="noTelp" value="<?php echo $objRegister->noTelp; ?>">
                                </div>

                                <!-- Jenis Kelamin -->
                                <div class="form-group">
                                    <label for="jenisKelamin">Jenis Kelamin</label></br>
                                    
                                        <?php
                                            $gender = array("F"=>"Perempuan", "M"=>"Laki-laki");
                                            foreach($gender as $key => $value) {	
                                                if($objRegister->gender == $key){
                                                    echo '<div class="custom-control custom-radio custom-control-inline">';
                                                    echo '<input type="radio" id="laki" name="jenisKelamin" class="custom-control-input" checked value="'.$key.'">';					
                                                    echo '<label class="custom-control-label" for="laki"> '.$value.'</label>';
                                                    echo '</div>';
                                                }else{
                                                    echo '<div class="custom-control custom-radio custom-control-inline">';
                                                    echo '<input type="radio" id="perempuan" name="jenisKelamin" class="custom-control-input" value="'.$key.'">';					
                                                    echo '<label class="custom-control-label" for="perempuan"> '.$value.'</label>';
                                                    echo '</div>';
                                                }
                                            }	
                                        ?>
                                    
                                </div>

                                <input type="submit" name="btnUpdate" class="btn btn-primary btn-block" value="Update My Profile">
                                <a href="dashboardMahasiswa.php" class="btn btn-light btn-block">Cancel</a>
                            
                            </form>
                        </div>
		            </div>
		            
		        </div>
		    </div>
		</div>
        </div>
    </div>
</div>

<!-- JS Tab Control -->
<script>
    $(document).ready(function () {
        $('input[name="pekerjaan"]').click(function () {
            $(this).tab('show');
            $(this).removeClass('active');
        });
    });

    $(".reveal").on('click',function() {
        const show = $('.fa');
        $(show).toggleClass('.fa fa-eye-slash');
        $(this).toggleClass('active');
        var $pwd = $(".pwd");
        if ($pwd.attr('type') === 'password') {
            $pwd.attr('type', 'text');
        } else {
            $pwd.attr('type', 'password');
        }
    });
</script>