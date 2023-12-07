<?php

    require_once('./class/class.Admin.php');
    require_once('./class/class.Prodi.php');
    require_once('./class/class.Peminjam.php');

    $objAdmin = new Admin();

    if(isset($_POST['btnSubmit'])){
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
            echo '<script> window.location = "dashboardAdmin.php?p=tambahAdmin"; </script>';
            }
        }
    }
?>

<div class="container">
    <div class="wrapper">
        <div class="row justify-content-center align-items-center " style="height:100%">
            <div class="col-6 ">
                <div class="card shadow p-3 mb-5 mt-5 bg-white rounded border-0">
                    <div class="card-body">
                        <h2>Tambah Admin</h2>
                        <p>Tambahkan admin yang berwenang</p> 
                        <form action="" autocomplete="off" method="POST">
                            
                            <!-- Full Name -->
                            <div class="form-group">
                                <label for="fullName">Full Name</label>
                                 <input type="text" class="form-control" name="fullname" id="fullName">
                            </div>

                            <!-- Email -->
                            <div class="form-group">
                                <label for="email">Email</label>
                                 <input type="email" class="form-control" name="email" id="email">
                            </div>

                            <!-- Password -->
                            <div class="form-group">
                                 <label for="pass">Password</label>
                                 <div class="input-group">
                                    <input type="password" class="form-control pwd" id="pass" name="pass">
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary reveal " type="button"><i class="fa fa-eye"></i></button>
                                    </span>          
                                </div>
                            </div>

                            <!-- Pekerjaan/Role -->
                            <div class="form-group" role="tab-list">
                                <label for="pekerjaan">Posisi</label></br>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="roleAdmin" name="pekerjaan" class="custom-control-input" value="Admin" data-target="#Kadiv-content">
                                    <label class="custom-control-label" for="roleAdmin">Admin Bag. Umum</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="roleKadiv" name="pekerjaan" class="custom-control-input" value="Kadiv" data-target="#Kadiv-content">
                                    <label class="custom-control-label" for="roleKadiv">Kepala Divisi</label>
                                </div>
                            </div>

                            <!-- Tab Input NIM, NIDN, dan Umum -->
                            <div class="tab-content">
                                <div class="form-group tab-pane" id="Kadiv-content">
                                    <label for="nidn">NIDN</label>
                                    <input type="number" class="form-control " name="nidn" id="nidn">
                                </div>
                            </div>

                            <!-- Alamat -->
                            <div class="form-group">
                                <label for="address">Alamat</label>
                                <textarea class="form-control" name="address" id="address" rows="3" style="height:100%"></textarea>
                            </div>

                            <!-- Nomer Telepon -->
                            <div class="form-group">
                                <label for="noTelp">Nomor Telepon</label>
                                <input type="number" class="form-control" name="noTelp" id="noTelp">
                            </div>

                            <!-- Jenis Kelamin -->
                            <div class="form-group">
                                <label for="jenisKelamin">Jenis Kelamin</label></br>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="laki" name="jenisKelamin" class="custom-control-input" value="M">
                                    <label class="custom-control-label" for="laki" >Laki-laki</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="perempuan" name="jenisKelamin" class="custom-control-input" value="F">
                                    <label class="custom-control-label" for="perempuan">Perempuan</label>
                                </div>
                            </div>

                            <input type="submit" name="btnSubmit" class="btn btn-primary btn-block" value="Save">
                            <a href="dashboardAdmin.php?p=tambahAdmin" class="btn btn-light btn-block">Cancel</a>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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