<?php
include_once 'class.Ruangan.php';
include_once 'class.Register.php';
class Peminjaman_Ruangan extends Connection{
    public $jamPinjam = '';
    public $jamSelesai = '';
    public $lamaPinjam = '';
    public $keperluan = '';
    public $tglSelesai = '';
    public $tglPinjam = '';
    public $persetujuan = '';
    public $tglPersetujuan = '';
    public $IDPeminjaman = '';
    public $UserID = '';
    public $IDRuangan = '';

    public $hasil = false;
    public $message = '';

    function __construct() {						
        $this->ruangan = new Ruangan();
        $this->user = new Register();
    }

    
    public function AddPeminjaman(){
        $this->connect();
        $sql = "INSERT INTO peminjaman_ruangan (jamPinjam, lamaPinjam, jamSelesai, keperluan, tglSelesai, tglPinjam, UserID, IDRuangan)
                VALUES ('$this->jamPinjam', '$this->lamaPinjam','$this->jamSelesai', '$this->keperluan', '$this->tglSelesai', '$this->tglPinjam', '$this->UserID', '$this->IDRuangan')";

        $this->hasil = mysqli_query($this->connection, $sql);

        if($this->hasil)
            $this->message = 'Data berhasil ditambahkan';
        else
            $this->message = 'Data gagal ditambahkan';
        
        return $this->connection->insert_id;
    }

    public function SetujuiPeminjaman(){
        $this->connect();
        $sql = "UPDATE peminjaman_ruangan SET persetujuan = 'Disetujui' WHERE IDPeminjaman = '$this->IDPeminjaman'";

        $this->hasil = mysqli_query($this->connection, $sql);

        if($this->hasil)
            $this->message = 'Persetujuan peminjaman berhasil disetujui';
        else
            $this->message = 'Peminjaman gagal untuk disetujui';
    }

    public function SetujuiPeminjamanKadiv(){
        $this->connect();
        $sql = "UPDATE peminjaman_ruangan SET persetujuan = 'Persetujuan 1' WHERE IDPeminjaman = '$this->IDPeminjaman'";

        $this->hasil = mysqli_query($this->connection, $sql);

        if($this->hasil)
            $this->message = 'Kepala Divisi berhasil menyetujui';
        else
            $this->message = 'Peminjaman gagal untuk disetujui';
    }

    public function TolakPeminjaman(){
        $this->connect();
        $sql = "UPDATE peminjaman_ruangan SET persetujuan = 'Tidak disetujui' WHERE IDPeminjaman = '$this->IDPeminjaman'";

        $this->hasil = mysqli_query($this->connection, $sql);

        if($this->hasil)
            $this->message = 'Persetujuan peminjaman telah ditolak';
        else
            $this->message = 'Peminjaman gagal untuk ditolak';
    }

    public function BatalkanPeminjaman(){
        $this->connect();
        $sql = "UPDATE peminjaman_ruangan SET persetujuan = 'Belum disetujui' WHERE IDPeminjaman = '$this->IDPeminjaman'";

        $this->hasil = mysqli_query($this->connection, $sql);

        if($this->hasil)
            $this->message = 'Persetujuan peminjaman telah ditolak';
        else
            $this->message = 'Peminjaman gagal untuk ditolak';
    }

    public function UpdatePeminjaman(){
        $this->connect();
        $sql = "UPDATE peminjaman_ruangan
                SET jamPinjam = '$this->nama',
                    lamaPinjam = '$this->email',
                    selesaiPinjam = '$this->password',
                    keperluan = '$this->alamat',
                    tglSelesai = '$this->role',
                    tglPinjam = '$this->noTelp'
                WHERE IDPeminjaman = '$this->IDPeminjaman' AND persetujuan = '' AND tglPersetujuan = ''";
        
        $this->hasil = mysqli_query($this->connection, $sql);

        if($this->hasil)
            $this->message = 'Data peminjaman ruangan berhasil diubah';
        else
            $this->message = 'Data gagal diubah';
    }

    public function DeletePeminjaman(){
        $this->connect();
        $sql = "DELETE FROM peminjaman_ruangan WHERE IDPeminjaman = '$this->IDPeminjaman'";
        $this->hasil = mysqli_query($this->connection, $sql);

        if($this->hasil)
            $this->message = 'Data berhasil dihapus';
        else
            $this->message = 'Data gagal dihapus';
    }

    public function SelectAllPeminjamanUser(){
        $this->connect();
        $sql = "SELECT pr.*, r.namaRuangan FROM peminjaman_ruangan pr JOIN ruangan r ON pr.IDRuangan = r.IDRuangan";
        $result = mysqli_query($this->connection, $sql);

        $arrResult = Array();
        $count=0;

        if(mysqli_num_rows($result) > 0){
            while ($data = mysqli_fetch_array($result)){
                $objPeminjaman = new Peminjaman_Ruangan();
                $objPeminjaman->IDPeminjaman=$data['IDPeminjaman'];
                $objPeminjaman->ruangan->namaRuangan=$data['namaRuangan'];
                $objPeminjaman->UserID=$data['UserID'];
                $objPeminjaman->tglPinjam=$data['tglPinjam'];
                $objPeminjaman->tglSelesai=$data['tglSelesai'];
                $objPeminjaman->jamPinjam=$data['jamPinjam'];
                $objPeminjaman->jamSelesai=$data['jamSelesai'];
                $objPeminjaman->keperluan=$data['keperluan'];
                $objPeminjaman->persetujuan=$data['persetujuan'];
                $objPeminjaman->tglPersetujuan=$data['tglPersetujuan'];
                
                $arrResult[$count] = $objPeminjaman;
                $count++;
            }
        }
        
        return $arrResult;
    }

    public function SelectAllPeminjaman(){
        $this->connect();
        $sql = "SELECT u.*, pr.*, r.* FROM userruangan u JOIN peminjaman_ruangan pr JOIN ruangan r ON pr.IDRuangan = r.IDRuangan WHERE u.UserID = pr.UserID";
        $result = mysqli_query($this->connection, $sql);

        $arrResult = Array();
        $count=0;

        if(mysqli_num_rows($result) > 0){
            while ($data = mysqli_fetch_array($result)){
                $objPeminjaman = new Peminjaman_Ruangan();
                $objPeminjaman->user->nama=$data['nama'];
                
                $objPeminjaman->user->email=$data['email'];
                $objPeminjaman->IDPeminjaman=$data['IDPeminjaman'];
                $objPeminjaman->user->UserID=$data['email'];
                $objPeminjaman->IDRuangan=$data['IDRuangan'];
                $objPeminjaman->ruangan->namaRuangan=$data['namaRuangan'];
                $objPeminjaman->UserID=$data['UserID'];
                $objPeminjaman->tglPinjam=$data['tglPinjam'];
                $objPeminjaman->tglSelesai=$data['tglSelesai'];
                $objPeminjaman->jamPinjam=$data['jamPinjam'];
                $objPeminjaman->jamSelesai=$data['jamSelesai'];
                $objPeminjaman->keperluan=$data['keperluan'];
                $objPeminjaman->persetujuan=$data['persetujuan'];
                $objPeminjaman->tglPersetujuan=$data['tglPersetujuan'];
                
                $arrResult[$count] = $objPeminjaman;
                $count++;
            }
        }
        
        return $arrResult;
    }
    
    public function SelectOnePeminjaman(){
        $this->connect();
        $sql = "SELECT * FROM peminjaman_ruangan WHERE IDPeminjaman='$this->IDPeminjaman'";
        $resultOne = mysqli_query($this->connection, $sql);

        if(mysqli_num_rows($resultOne) == 1){
            $this->hasil = true;
            $data = mysqli_fetch_assoc($resultOne);
            $this->jamPinjam  = $data['jamPinjam'];
            $this->IDRuangan=$data['IDRuangan'];
            $this->UserID=$data['UserID'];
            $this->tglPinjam=$data['tglPinjam'];
            $this->tglSelesai=$data['tglSelesai'];
            $this->jamPinjam=$data['jamPinjam'];
            $this->jamSelesai=$data['jamSelesai'];
            $this->keperluan=$data['keperluan'];
            $this->persetujuan=$data['persetujuan'];
            $this->tglPersetujuan=$data['tglPersetujuan'];
            
        }
    }
}


?>