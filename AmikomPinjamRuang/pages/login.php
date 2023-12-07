  
<?php
    require_once('./class/class.Register.php');
    require_once('./class/class.Peminjam.php');

    if (isset($_POST['btnLogin'])) {

        $inputEmail = $_POST['email'];
        $inputPassword = $_POST['pwd'];

        $objRegister = new Register();
        $objPeminjam = new Peminjam();
        $objRegister->ValidateEmail($inputEmail);

        if ($objRegister->hasil) {
            
            $ismatch = password_verify($inputPassword, $objRegister->password);

            if ($ismatch) {
                if (!isset($_SESSION)) {
                    session_start();
                }

                $_SESSION["UserID"] = $objRegister->UserID;
                $_SESSION["role"] = $objRegister->role;
                $_SESSION["nama"] = $objRegister->nama;
                $_SESSION["email"] = $objRegister->email;

                echo "<script> alert('Login sukses!'); </script>";

                if ($objRegister->role == 'Mahasiswa') 
                    echo '<script> window.location = "dashboardMahasiswa.php"; </script>';
                 else if ($objRegister->role == 'Dosen')
                    echo '<script> window.location = "dashboardMahasiswa.php"; </script>';
                 else if ($objRegister->role == 'Kadiv') 
                    echo '<script> window.location = "dashboardAdmin.php"; </script>'; 
                 else if ($objRegister->role == 'Admin') 
                    echo '<script> window.location = "dashboardAdmin.php"; </script>';
                 else if ($objRegister->role == 'Umum') 
                    echo '<script> window.location = "dashboardMahasiswa.php"; </script>';
                
            } else{
                echo "<script> alert('Password tidak match!'); </script>";
            }
        } else{
            echo "<script> alert('Email tidak terdaftar!'); </script>";
        }
    }
?>

<div class="container">
    <div class="row justify-content-center align-items-center " style="min-height:100vh">
        <div class="col-4">
            <div class="card shadow p-3 mb-5 mt-5 bg-white rounded border-0">
                <div class="card-body">
                    <h2>Login</h2> 
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="email"> Email address</label>
                                <input type="email" class="form-control" name="email" id="email" required>
                        </div>

                        <div class="form-group">
                            <label for="pwd">Password</label>
                            <!-- <input type="password" class="form-control" name="pwd" id="pwd" maxlength="20" required> -->
                            <div class="input-group">
                                <input type="password" class="form-control pwd" id="pwd" name="pwd" maxlength="20"  required>
                                <span class="input-group-btn">
                                    <button class="btn btn-primary reveal" type="button"><i class="fa fa-eye "></i></button>
                                </span>          
                            </div>
                        </div>
                    
                        <!-- <div class="form-group form-check custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input form-check-input" id="remember">
                            <label class="custom-control-label form-check-label" for="remember">Remember me</label>
                        </div> -->

                        <input type="submit" name="btnLogin" class="btn btn-primary btn-block" value="Login">
                        <a href="index.php" class="btn btn-light btn-block">Cancel</a></td>
                        
                    </form>
                    <p><small>Belum punya akun? <a href="index.php?p=register">Daftar sekarang</a></small></p>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
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