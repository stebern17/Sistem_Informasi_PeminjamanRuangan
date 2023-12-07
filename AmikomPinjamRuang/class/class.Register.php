<?php

    // include 'class.Peminjam.php';

    class Register extends Connection{
        public $UserID = 0;
        public $nama = '';
        public $email = '';
        public $password = '';
        public $alamat = '';
        public $role = '';
        public $noTelp = '';
        public $gender = '';

        public $hasil = false;
        public $message = '';

        
        public function AddMember(){
            $this->connect();
            $sql = "INSERT INTO userruangan (nama, email, password, alamat, role, noTelp, gender)
                    VALUES ('$this->nama','$this->email', '$this->password', '$this->alamat', '$this->role', '$this->noTelp', '$this->gender')";

            $this->hasil = mysqli_query($this->connection, $sql);

            if($this->hasil){
                $this->message = 'Data berhasil ditambahkan';
            }else{
                $this->message = 'Data gagal ditambahkan';
            }
            return $this->connection->insert_id;
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

        public function UpdateMember(){
            $this->connect();
            $sql = "UPDATE userruangan
                    SET nama = '$this->nama',
                        email = '$this->email',
                        password = '$this->password',
                        alamat = '$this->alamat',
                        role = '$this->role',
                        noTelp = '$this->noTelp',
                        gender = '$this->gender'
                    WHERE UserID = '$this->UserID'";
            
            $this->hasil = mysqli_query($this->connection, $sql);

            if($this->hasil)
                $this->message = 'Data berhasil diubah';
            else
                $this->message = 'Data gagal diubah';
        }

        public function DeleteMember(){
            $this->connect();
            $sql = "DELETE FROM userruangan WHERE UserID = '$this->UserID'";
            $this->hasil = mysqli_query($this->connection, $sql);

            if($this->hasil)
                $this->message = 'Data berhasil dihapus';
            else
                $this->message = 'Data gagal dihapus';
        }

        public function SelectOneMember(){
            $this->connect();
            $sql = "SELECT * FROM userruangan WHERE UserID='$this->UserID'";
            $resultOne = mysqli_query($this->connection, $sql);
    
            if(mysqli_num_rows($resultOne) == 1){
                $this->hasil = true;
                $data = mysqli_fetch_assoc($resultOne);
                $this->nama = $data['nama'];
                $this->email = $data['email'];
                $this->password = $data['password'];
                $this->alamat = $data['alamat'];
                $this->role = $data['role'];
                $this->noTelp = $data['noTelp'];
                $this->gender = $data['gender'];
            }
        }

        public function SelectOneMemberByID($ID){
            $this->connect();
            $sql = "SELECT u.email, u.nama FROM userruangan u JOIN peminjaman_ruangan pr ON u.UserID = pr.UserID WHERE pr.IDPeminjaman = $ID GROUP BY u.email";
            $resultOne = mysqli_query($this->connection, $sql);
    
            if(mysqli_num_rows($resultOne) == 1){
                $this->hasil = true;
                $data = mysqli_fetch_assoc($resultOne);
                $this->nama = $data['nama'];
                $this->email = $data['email'];
            }
        }

        public function SelectAllMember(){
            $this->connect();
            $sql = "SELECT * FROM userruangan";
            $result = mysqli_query($this->connection, $sql);
            $arrResult = Array();
            $count = 0;

            if (mysqli_num_rows($result) > 0) {
                while($data = mysqli_fetch_array($result)){
                    $objRegister = new Register();
                    $objRegister->UserID = $data['UserID'];
                    $objRegister->nama = $data['nama'];
                    $objRegister->email = $data['email'];
                    $objRegister->password = $data['password'];
                    $objRegister->alamat = $data['alamat'];
                    $objRegister->role = $data['role'];
                    $objRegister->noTelp = $data['noTelp'];
                    $objRegister->gender = $data['gender'];
                    $arrResult[$count] = $objRegister;
                    $count++;
                }
            }
            return $arrResult;

        }
    }

?>