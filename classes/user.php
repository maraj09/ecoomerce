<?php
    class user{
        private $db;
        private $fm;

        public function __construct(){
            $this->db= new Database();
            $this->fm= new Format();
        }
        public function insertuser($data,$files){
            $name = $this->fm->validation($data['name']);
            $name = mysqli_real_escape_string($this->db->link,$data['name']);
            $address = $this->fm->validation($data['address']);
            $address = mysqli_real_escape_string($this->db->link,$data['address']);
            $city = $this->fm->validation($data['city']);
            $city = mysqli_real_escape_string($this->db->link,$data['city']);
            $country = $this->fm->validation($data['country']);
            $country = mysqli_real_escape_string($this->db->link,$data['country']);
            $email = $this->fm->validation($data['email']);
            $email = mysqli_real_escape_string($this->db->link,$data['email']);
            $pass = $this->fm->validation($data['pass']);
            $pass = mysqli_real_escape_string($this->db->link,md5($data['pass']));

            $permited  = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $files['avatar']['name'];
            $file_size = $files['avatar']['size'];
            $file_temp = $files['avatar']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "images/".$unique_image;

            $emailquery =  " SELECT * FROM users WHERE email='$email' ";
            $mailchk = $this->db->select($emailquery );
                if ($mailchk) {
                    $msg = '<p style="color:red; font-size:17px">Email Address Already In Use !</p>' ;
                    return $msg;        
                }else{
                if (!empty($file_name)) {
                    if (in_array($file_ext, $permited) === false) {
                        $msg= "<p style= ' color: red; font-size:17px' >You can upload only:-".implode(', ', $permited)."</p>";
                        return $msg;
                    }else{
                            move_uploaded_file($file_temp, $uploaded_image);
                            $query = " INSERT INTO users(name,address,city,country,email,pass,avatar) VALUES('$name','$address','$city','$country','$email','$pass','$uploaded_image')  ";
                            $result = $this->db->insert($query);
                            if ($result) {
                                
                            }   
                    }
                }else {
                    $query = " INSERT INTO users(name,address,city,country,email,pass) VALUES('$name','$address','$city','$country','$email','$pass')  ";
                    $result = $this->db->insert($query);
                    if ($result) {
                        header("location:index.php?success");
                    }   
                }
            }
            
        }
        public function matchuser($data){
            $email = $this->fm->validation($data['name']);
            $email = mysqli_real_escape_string($this->db->link,$data['name']);
            $pass  = $this->fm->validation($data['pass']);
            $pass  = mysqli_real_escape_string($this->db->link,md5($data['pass']));
            $query  = "SELECT * FROM users WHERE email ='$email' AND pass='$pass'";
            $result = $this->db->select($query);
            if ($result) {
                $value = $result->fetch_assoc();
                Session::set("usrlogin",true);
                Session::set("userId",$value ['userId']);
                Session::set("userName",$value ['name']);
                Session::set("avatar",$value ['avatar']);
                header("location:./index.php");
            }else{
                $script =  "<script> document.getElementById('modal-wrapper').style.display='block'; </script>";
                return $script;
            }
        }
    }

?>