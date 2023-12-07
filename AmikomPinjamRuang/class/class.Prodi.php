<?php

class Prodi extends Connection{
    public $IDProdi = '';
    public $kaprodi = '';
    public $namaProdi = '';

    public $hasil = false;
    public $message = '';

    public function AddProdi(){
        $this->connect();
        $sql = "INSERT INTO prodi (kaprodi, namaProdi)
                VALUES ('$this->kaprodi','$this->namaProdi')";

        $this->hasil = mysqli_query($this->connection, $sql);
        

        if($this->hasil)
            $this->message = 'Data berhasil ditambahkan';
        else
            $this->message = 'Data gagal ditambahkan';
            
    }

    public function UpdateProdi(){
        $this->connect();
        $sql = "UPDATE prodi
                SET kaprodi = '$this->kaprodi',
                    namaProdi = '$this->namaProdi'
                WHERE IDProdi = '$this->IDProdi'";
        
        $this->hasil = mysqli_query($this->connection, $sql);

        if($this->hasil)
            $this->message = 'Data berhasil diubah';
        else
            $this->message = 'Data gagal diubah';
            echo $sql;
    }

    public function DeleteProdi(){
        $this->connect();
        $sql = "DELETE FROM prodi WHERE IDProdi = '$this->IDProdi'";
        $this->hasil = mysqli_query($this->connection, $sql);

        if($this->hasil)
            $this->message = 'Data berhasil dihapus';
        else
            $this->message = 'Data gagal dihapus';
    }


    public function SelectAllProdi(){
        $this->connect();
        $sql = "SELECT * FROM prodi";
        $result = mysqli_query($this->connection, $sql);

        $arrResult = Array();
        $count=0;
        
            while ($data = mysqli_fetch_array($result)){
                $objProdi = new Prodi();
                $objProdi->IDProdi=$data['IDProdi'];
                $objProdi->kaprodi=$data['kaprodi'];
                $objProdi->namaProdi=$data['namaProdi'];
                $arrResult[$count] = $objProdi;
                $count++;
            }
        
        return $arrResult;
    }

    public function SelectOneProdi(){
        $this->connect();
        $sql = "SELECT * FROM prodi WHERE IDProdi='$this->IDProdi'";
        $resultOne = mysqli_query($this->connection, $sql);

        if(mysqli_num_rows($resultOne) == 1){
            $this->hasil = true;
            $data = mysqli_fetch_assoc($resultOne);
            $this->kaprodi = $data['kaprodi'];
            $this->namaProdi = $data['namaProdi'];
        }
    }
}

?>