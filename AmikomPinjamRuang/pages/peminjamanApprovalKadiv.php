<?php

    require_once('./class/class.Peminjaman.php');
    require_once('./class/class.Register.php');
    require_once('./class/class.Mail.php');

    if(isset($_GET['IDPeminjaman'])){
        $objPeminjaman = new Peminjaman_Ruangan();
        $objRegister = new Register();
        $IDPeminjaman = $_GET['IDPeminjaman'];
        $objRegister->SelectOneMemberByID($IDPeminjaman);
        $objPeminjaman->IDPeminjaman = $IDPeminjaman;
        $objPeminjaman->SetujuiPeminjamanKadiv();

        if($objPeminjaman->hasil){			
            $message =  file_get_contents('templateemail.html');  					 
            $header = "Kepala Divisi Telah Menyetujui";
            $body = '<span style="font-family: Arial, Helvetica, sans-serif; font-size: 15px; color: #57697e;">
                        <table id="pinjam" >
                        <tr>
                            <td colspan="3" align="center">
                                <h2>Form Penggunaan Ruangan</h2>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Persetujuan
                            </td>
                            <td align:"left">
                                :
                            </td>
                            <td>
                                Ka. Divisi Telah Menyetujui
                            </td>
                        </tr></br>
                    </span>';
                    
            $footer ='Tinggal satu langkah lagi untuk meminjam ruangan, silakan login untuk memantau persetujuan peminjaman ruangan';
                                        
            $message = str_replace("#header#",$header,$message);
            $message = str_replace("#body#",$body,$message);
            $message = str_replace("#footer#",$footer,$message);
                                             
            $objMail = new Mail();
            $objMail->SendMail($objRegister->email, $objRegister->nama, 'Kepala Divisi Telah Menyetujui', $message);	
            echo "<script> alert('Persetujuan Kepala Divisi Berhasil'); </script>";
            echo '<script> window.location="dashboardAdmin.php?p=adminListPeminjaman"; </script>'; 				
        }

    } else{
        echo '<script> window.history.back() </script>';
    }

?>