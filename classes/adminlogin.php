<?php
    class adminLogin{
        private $db;
        private $fm;

        public function __construct(){
            $this->db= new Database();
            $this->fm= new Format();
        }
        public function adminLogin($adminUser,$adminPass){
            $adminUser =$this->fm->validation($adminUser);
            $adminPass =$this->fm->validation($adminPass);
            $adminUser = mysqli_real_escape_string($this->db->link,$adminUser);
            $adminPass = mysqli_real_escape_string($this->db->link,$adminPass);
            $query = " SELECT * FROM admins WHERE userName =  '$adminUser' AND userPass = '$adminPass' ";
            $result = $this->db->select($query);
            if ($result !=false) {
                $value = $result->fetch_assoc();
                Session::set("login",true);
                Session::set("adminId",$value["adminId"]);
                Session::set("userName",$value["userName"]);
                Session::set("adminName",$value["adminName"]);
                
                header("location:index.php");
            }else{
                $loginmsg = "Username or Password Was Wrong";
                return $loginmsg;
            }
        }
    }
?>