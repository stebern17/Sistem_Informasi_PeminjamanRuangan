<?php ob_start();
    require ("../inc.koneksi.php");
    require_once('../html2pdf/html2pdf.class.php');
    require_once('../class/class.Peminjaman.php');
    
    $year = date("Y");
    $judul = 'Laporan Data Peminjaman Ruangan ESQBS '.$year;
    $content = '<h3><b>'.$judul.'</b></h3>';

    $objPeminjaman = new Peminjaman_Ruangan();
    $arrayResult = $objPeminjaman->SelectAllPeminjaman();
    $content.= '<table style="border: 1px solid #ddd; border-collapse: collapse; width: 80%;">';
    $content.= '<tr>
                    <th style="background-color: #007bff; color: white; padding: 10px;">No.</th>
                    <th style="background-color: #007bff; color: white; padding: 10px;">Ruangan</th>
                    <th style="background-color: #007bff; color: white; padding: 10px;">Tgl Pinjam</th>
                    <th style="background-color: #007bff; color: white; padding: 10px;">Tgl Selesai</th>
                    <th style="background-color: #007bff; color: white; padding: 10px;">Jam Pinjam—Selesai</th>
                    <th style="background-color: #007bff; color: white; padding: 10px;">Persetujuan</th>
                    <th style="background-color: #007bff; color: white; padding: 10px;">Tgl Persetujuan</th>
                </tr>';
    
    if (count($arrayResult) == 0) {
        $content.= '<tr><td colspan="8" style="text-align: center;">Tidak ada data!</td></tr>';
    } else {
        $no = 1;
        foreach($arrayResult as $dataPeminjaman){
            if ($dataPeminjaman->role != 'Admin') {
                $content.= '<tr>';
                $content.= '<td style="border: 1px solid #ddd; padding: 10px;">'.$no.'</td>';
                $content.= '<td style="border: 1px solid #ddd; padding: 10px; white-space: nowrap; overflow: hidden; width: 70px; text-overflow: ellipsis; table-layout: fixed;">'.$dataPeminjaman->ruangan->namaRuangan.'</td>';
                $content.= '<td style="border: 1px solid #ddd; padding: 10px;">'.$dataPeminjaman->tglPinjam.'</td>';
                $content.= '<td style="border: 1px solid #ddd; padding: 10px;">'.$dataPeminjaman->tglSelesai.'</td>';
                $content.= '<td style="border: 1px solid #ddd; padding: 10px;">'.$dataPeminjaman->jamPinjam.'—'.$dataPeminjaman->jamSelesai.'</td>';
                $content.= '<td style="border: 1px solid #ddd; padding: 10px;">'.$dataPeminjaman->persetujuan.'</td>'; 
                $content.= '<td style="border: 1px solid #ddd; padding: 10px;">'.$dataPeminjaman->tglPersetujuan.'</td>';                             
                $content.= '</tr>';
                $no++;
            }  
        }
    }

    $content .= '</table>';

    $html2pdf = new HTML2PDF('P', 'A4', 'fr');
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    ob_end_clean();
    $html2pdf->Output($judul.'.pdf', 'FI');
?>