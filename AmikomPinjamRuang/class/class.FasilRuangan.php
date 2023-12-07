<?php

include_once 'class.Fasilitas.php';

class FasilRuangan extends Connection{
    public $IDFasilRuangan = 0;
    public $IDFasilitas = '';
    public $jumlah = '';
    public $IDPeminjaman = '';

    public $hasil = false;
    public $message = '';

    function __construct() {						
        $this->fasil = new Fasilitas();
    }

    public function AddFasilRuangan($sql){
        $this->connect();
        $this->hasil = mysqli_query($this->connection, $sql);
        
        if($this->hasil)
            $this->message = 'Data berhasil ditambahkan';
        else
            $this->message = 'Data gagal ditambahkan';
    }

    public function SelectAllFasilRuanganWithID($IDPeminjaman){
        $this->connect();
        $sql = "SELECT f.jenisFasilitas, fr.jumlah FROM fasilitas_ruangan fr JOIN fasilitas f ON fr.IDFasilitas = f.IDFasilitas WHERE fr.IDPeminjaman = $IDPeminjaman ";
        $result = mysqli_query($this->connection, $sql);

        $arrResult = Array();
        $count=0;
        
            while ($data = mysqli_fetch_array($result)){
                $objFasilRuangan = new FasilRuangan();
                $objFasilRuangan->jumlah=$data['jumlah'];
                $objFasilRuangan->fasil->jenisFasilitas=$data['jenisFasilitas'];
                $arrResult[$count] = $objFasilRuangan;
                $count++;
            }
        
        return $arrResult;
    }

    public function UpdateFasilRuangan(){
        $this->connect();
        $sql = "UPDATE fasilitas_ruangan
                SET IDFasilitas = '$this->IDFasilitas',
                    jumlah = '$this->jumlah',
                    jumlah = '$this->IDPeminjaman'
                WHERE IDFasilRuangan = '$this->IDFasilRuangan'";
        
        $this->hasil = mysqli_query($this->connection, $sql);

        if($this->hasil)
            $this->message = 'Data berhasil diubah';
        else
            $this->message = 'Data gagal diubah';
    }

    public function DeleteFasilRuangan(){
        $this->connect();
        $sql = "DELETE FROM fasilitas_ruangan WHERE IDFasilRuangan = '$this->IDFasilRuangan'";
        $this->hasil = mysqli_query($this->connection, $sql);

        if($this->hasil)
            $this->message = 'Data berhasil dihapus';
        else
            $this->message = 'Data gagal dihapus';
    }


    public function SelectAllFasilRuangan(){
        $this->connect();
        $sql = "SELECT * FROM fasilitas_ruangan";
        $result = mysqli_query($this->connection, $sql);

        $arrResult = Array();
        $count=0;
        
            while ($data = mysqli_fetch_array($result)){
                $objFasilRuangan = new FasilRuangan();
                $objFasilRuangan->IDFasilRuangan=$data['IDFasilRuangan'];
                $objFasilRuangan->IDFasilitas=$data['IDFasilitas'];
                $objFasilRuangan->jumlah=$data['jumlah'];
                $objFasilRuangan->IDPeminjaman=$data['IDPeminjaman'];
                $arrResult[$count] = $objFasilRuangan;
                $count++;
            }
        
        return $arrResult;
    }

    public function SelectOneFasilRuangan(){
        $this->connect();
        $sql = "SELECT * FROM fasilitas_ruangan WHERE IDFasilRuangan='$this->IDFasilRuangan'";
        $resultOne = mysqli_query($this->connection, $sql);

        if(mysqli_num_rows($resultOne) == 1){
            $this->hasil = true;
            $data = mysqli_fetch_assoc($resultOne);
            $this->IDFasilitas = $data['IDFasilitas'];
            $this->jumlah = $data['jumlah'];
            $this->IDPeminjaman = $data['IDPeminjaman'];
        }
    }
}

?>