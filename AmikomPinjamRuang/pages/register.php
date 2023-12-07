<?php

    require_once('./class/class.Register.php');
    require_once('./class/class.Prodi.php');
    require_once('./class/class.Peminjam.php');
    require_once('./class/class.Mail.php');

    $objRegister = new Register();
    $objPeminjam = new Peminjam();
    $objProdi = new Prodi();

    $prodiList = $objProdi->SelectAllProdi();

    if(isset($_POST['btnSubmit'])){
        $inputEmail = $_POST['email'];
        
        $objRegister->ValidateEmail($inputEmail);
        $objRegister->hasil = false;

        if ($objRegister->hasil) {
            echo "<script> alert('Email sudah terdaftar'); </script>";
        }else {
            $objRegister->email = $_POST['email'];
            $password = $_POST['pass'];
            $objRegister->password = password_hash($password, PASSWORD_DEFAULT);
            $objRegister->nama = $_POST['fullname'];
            $objRegister->alamat = $_POST['address'];
            $objRegister->role = $_POST['pekerjaan'];
            $objRegister->noTelp = $_POST['noTelp'];
            $objRegister->gender = $_POST['jenisKelamin'];
            $objPeminjam->NIM = $_POST['nim'];
            $objPeminjam->NIDN = $_POST['nidn'];
            $objPeminjam->IDProdi = $_POST['prodi'];
            $IDPeminjam = $objRegister->AddMember();
            $objPeminjam->AddPeminjam($IDPeminjam);

            if($objPeminjam->hasil){			
                $message =  file_get_contents('templateemail.html');  					 
                $header = "Registrasi berhasil";
                $body = '<span style="font-family: Arial, Helvetica, sans-serif; font-size: 15px; color: #57697e;">
                        Selamat <b>' .$objRegister->nama.'</b>, anda telah terdaftar pada sistem peminjaman ruangan online ESQ Business School.<br>
                        Berikut ini informasi akun anda:<br>
                        </span>
                        <span style="font-family: Arial, Helvetica, sans-serif; font-size: 15px; color: #57697e;">
                            Username : '.$objRegister->email.'<br>
                            Password : '.$password.'
                        </span>';
                $footer ='Silakan login untuk mengakses sistem peminjaman ruangan';
                                            
                $message = str_replace("#header#",$header,$message);
                $message = str_replace("#body#",$body,$message);
                $message = str_replace("#footer#",$footer,$message);
                                                 
                $objMail = new Mail();
                $objMail->SendMail($objRegister->email, $objRegister->nama, 'Registrasi berhasil', $message);	
                echo "<script> alert('Registrasi berhasil'); </script>";
                echo '<script> window.location="index.php?p=login"; </script>'; 				
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
                        <h2>Register</h2>
                        <p>Daftar menjadi peminjam ruangan di Universitas Amikom Yogyakarta</p> 
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
                                 <!-- <input type="password" class="form-control" id="pass" name="pass" autocomplete="off"> -->
                                 <div class="input-group">
                                    <input type="password" class="form-control pwd" id="pass" name="pass">
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary reveal " type="button"><i class="fa fa-eye"></i></button>
                                    </span>          
                                </div>
                            </div>

                            <!-- Pekerjaan/Role -->
                            <div class="form-group" role="tab-list">
                                <label for="pekerjaan">Pekerjaan</label></br>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="roleMahasiswa" name="pekerjaan" class="custom-control-input" value="Mahasiswa" data-target="#nim-content">
                                    <label class="custom-control-label" for="roleMahasiswa">Mahasiswa</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="roleDosen" name="pekerjaan" class="custom-control-input" value="Dosen" data-target="#nidn-content">
                                    <label class="custom-control-label" for="roleDosen">Dosen</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="roleUmum" name="pekerjaan" class="custom-control-input" value="Umum" data-target="#umum">
                                    <label class="custom-control-label" for="roleUmum">Umum</label>
                                </div>
                            </div>

                            <!-- Tab Input NIM, NIDN, dan Umum -->
                            <div class="tab-content">
                                <div class="form-group tab-pane" id="nim-content">
                                    <label for="nim">NIM</label>
                                    <input type="number" class="form-control" name="nim" id="nim">
                                </div>
                                <div class="form-group tab-pane" id="nidn-content">
                                    <label for="nidn">NIDN</label>
                                    <input type="number" class="form-control " name="nidn" id="nidn">
                                </div>
                                <div id="umum">
                                </div>
                            </div>

                            <!-- Prodi -->
                            <div class="form-group">
                                <label for="prodi">Prodi</label>
                                <select name="prodi" class="form-control" id="prodi">
                                    <?php
                                        foreach($prodiList as $prodi){
                                            echo '<option value='.$prodi->IDProdi.'>'.$prodi->namaProdi.'</option>';
                                        }
                                    ?>
                                </select>
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

                            <input type="submit" name="btnSubmit" class="btn btn-primary btn-block" value="Register">
                            <a href="index.php?p=login" class="btn btn-light btn-block">Cancel</a>
                            
                        </form>
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