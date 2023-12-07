<?php

    include 'class.Peminjam.php';

    class Admin extends Connection{
        public $UserID = 0;
        public $nama = '';
        public $email = '';
        public $password = '';
        public $alamat = '';
        public $role = '';
        public $noTelp = '';
        public $gender = '';

        // Admin
        public $NIDN = '';

        public $hasil = false;
        public $message = '';

        function __construct() {			
			// parent::__construct();
			$this->Peminjam = new Peminjam();
		}

        
        public function AddAdmin(){
            $this->connect();
            $sql = "INSERT INTO userruangan (nama, email, password, alamat, role, noTelp, gender)
                    VALUES ('$this->nama','$this->email', '$this->password', '$this->alamat', '$this->role', '$this->noTelp', '$this->gender')";

            $this->hasil = mysqli_query($this->connection, $sql);

            $UserID = $this->connection->insert_id;
            $sql = "INSERT INTO `admin` (NIDN, UserID) VALUES ('$this->NIDN','$UserID')";

            $this->hasil = mysqli_query($this->connection, $sql);

            if($this->hasil)
                $this->message = 'Data berhasil ditambahkan';
            else
                $this->message = 'Data gagal ditambahkan';
        }

        public function ValidateEmail($inputEmail){
            $this->connect();
            
            $sql = "SELECT * FROM userruangan WHERE email = '$inputEmail'";
            
            $result = mysqli_query($this->connection, $sql);

            if(mysqli_num_rows($result) == 1){
                $this->hasil = true;
                $data = mysqli_fetch_assoc($result);
                $this->UserID = $data['UserID'];
                $this->nama = $data['nama'];
                $this->email = $data['email'];
                $this->password = $data['password'];
                $this->alamat = $data['alamat'];
                $this->role = $data['role'];
                $this->noTelp = $data['noTelp'];
                $this->gender = $data['gender'];
            }
        }

        public function UpdateAdmin(){
            $this->connect();
            $sql = "UPDATE `admin`
                    SET NIDN = '$this->NIDN'
                    WHERE UserID = '$this->UserID'";
            
            $this->hasil = mysqli_query($this->connection, $sql);

            if($this->hasil)
                $this->message = 'Data berhasil diubah';
            else
                $this->message = 'Data gagal diubah';
        }

        public function DeleteAdmin(){
            $this->connect();
            $sql = "DELETE FROM `admin` WHERE UserID = '$this->UserID'";
            $this->hasil = mysqli_query($this->connection, $sql);

            if($this->hasil)
                $this->message = 'Data berhasil dihapus';
            else
                $this->message = 'Data gagal dihapus';
        }

        public function SelectOneAdmin(){
            $this->connect();
            $sql = "SELECT * FROM `admin` WHERE UserID='$this->UserID'";
            $resultOne = mysqli_query($this->connection, $sql);
    
            if(mysqli_num_rows($resultOne) == 1){
                $this->hasil = true;
                $data = mysqli_fetch_assoc($resultOne);
                $this->NIDN = $data['NIDN'];
            }
        }

        public function SelectAllAdmin(){
            $this->connect();
            $sql = "SELECT * FROM `admin`";
            $result = mysqli_query($this->connection, $sql);
            $arrResult = Array();
            $count = 0;

            if (mysqli_num_rows($result) > 0) {
                while($data = mysqli_fetch_array($result)){
                    $objAdmin = new Admin();
                    $objAdmin->UserID = $data['UserID'];
                    $objAdmin->NIDN = $data['NIDN'];
                    $arrResult[$count] = $objAdmin;
                    $count++;
                }
            }
            return $arrResult;

        }
    }

?>