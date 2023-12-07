<?php

    require_once('./class/class.Admin.php');
    require_once('./class/class.Register.php');

    $objAdmin = new Admin();
    $objRegister = new Register();
    
    if(isset($_POST['btnUpdate'])){
        $inputEmail = $_POST['email'];
        
        $objAdmin->ValidateEmail($inputEmail);
        $objAdmin->hasil = false;

        if ($objAdmin->hasil) {
            echo "<script> alert('Email sudah terdaftar'); </script>";
        }else {
            
            $objAdmin->email = $_POST['email'];
            $password = $_POST['pass'];
            $objAdmin->password = password_hash($password, PASSWORD_DEFAULT);
            $objAdmin->nama = $_POST['fullname'];
            $objAdmin->alamat = $_POST['address'];
            $objAdmin->role = $_POST['pekerjaan'];
            $objAdmin->noTelp = $_POST['noTelp'];
            $objAdmin->gender = $_POST['jenisKelamin'];
            $objAdmin->NIDN = $_POST['nidn'];
            $objAdmin->AddAdmin();
            
            if($objAdmin->hasil){
            echo "<script> alert('$objAdmin->message'); </script>";
            echo '<script> window.location = "dashboardAdmin.php?p=adminProfile"; </script>';
            }
        } 
    } else if (isset($_SESSION['UserID'])) {
        $objAdmin->UserID = $_SESSION['UserID'];
        $objRegister->UserID = $_SESSION['UserID'];
        $objAdmin->SelectOneAdmin();
        $objRegister->SelectOneMember();
        
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
                                    <input type="password" class="form-control pwd" id="pass" name="pass" value="<?php echo $objRegister->password; ?>">
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary reveal " type="button"><i class="fa fa-eye"></i></button>
                                    </span>          
                                </div>
                            </div>

                            <!-- Pekerjaan/Role -->
                            <div class="form-group">
                                <label for="pekerjaan">Pekerjaan</label></br>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="roleDosen" name="pekerjaan" class="custom-control-input" checked value="Admin">
                                    <label class="custom-control-label" for="roleDosen">Dosen</label>
                                </div>
                            </div>
                            

                            <!-- Tab Input NIM, NIDN, dan Umum -->
                            <div class="form-group">
                                    <label for="nidn">NIDN</label>
                                    <input type="number" class="form-control " name="nidn" id="nidn" value="<?php echo $objAdmin->NIDN; ?>">
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

                            <input type="submit" name="btnUpdate" class="btn btn-primary btn-block" value="Save">
                            <a href="dashboardAdmin.php" class="btn btn-light btn-block">Cancel</a>
                            
                            
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