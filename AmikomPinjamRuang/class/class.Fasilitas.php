<?php


class Fasilitas extends Connection{
    public $IDFasilitas = '';
    public $jenisFasilitas = '';

    public $hasil = false;
    public $message = '';

    public function AddFasilitas(){
        $this->connect();
        $sql = "INSERT INTO fasilitas (jenisFasilitas)
                VALUES ('$this->jenisFasilitas')";

        $this->hasil = mysqli_query($this->connection, $sql);
        

        if($this->hasil)
            $this->message = 'Data berhasil ditambahkan';
        else
            $this->message = 'Data gagal ditambahkan';
            
    }

    public function UpdateFasilitas(){
        $this->connect();
        $sql = "UPDATE fasilitas
                SET jenisFasilitas = '$this->jenisFasilitas'
                WHERE IDFasilitas = '$this->IDFasilitas'";
        
        $this->hasil = mysqli_query($this->connection, $sql);

        if($this->hasil)
            $this->message = 'Data berhasil diubah';
        else
            $this->message = 'Data gagal diubah';
    }

    public function DeleteFasilitas(){
        $this->connect();
        $sql = "DELETE FROM fasilitas WHERE IDFasilitas = '$this->IDFasilitas'";
        $this->hasil = mysqli_query($this->connection, $sql);

        if($this->hasil)
            $this->message = 'Data berhasil dihapus';
        else
            $this->message = 'Data gagal dihapus';
    }


    public function SelectAllFasilitas(){
        $this->connect();
        $sql = "SELECT * FROM fasilitas";
        $result = mysqli_query($this->connection, $sql);

        $arrResult = Array();
        $count=0;
        
            while ($data = mysqli_fetch_array($result)){
                $objFasilitas = new Fasilitas();
                $objFasilitas->IDFasilitas=$data['IDFasilitas'];
                $objFasilitas->jenisFasilitas=$data['jenisFasilitas'];
                $arrResult[$count] = $objFasilitas;
                $count++;
            }
        
        return $arrResult;
    }

    public function SelectOneFasilitas(){
        $this->connect();
        $sql = "SELECT * FROM fasilitas WHERE IDFasilitas='$this->IDFasilitas'";
        $resultOne = mysqli_query($this->connection, $sql);

        if(mysqli_num_rows($resultOne) == 1){
            $this->hasil = true;
            $data = mysqli_fetch_assoc($resultOne);
            $this->jenisFasilitas = $data['jenisFasilitas'];
        }
    }
}

?>