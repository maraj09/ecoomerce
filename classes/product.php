<?php
    class product{
        private $db;
        private $fm;
        public function __construct(){
            $this->db= new Database();
            $this->fm= new Format();
        }
        
        public function productinsert($data,$files){
            $proName = $this->fm->validation($data['proName']);
            $proName = mysqli_real_escape_string($this->db->link,$data['proName']);
            $catId   = mysqli_real_escape_string($this->db->link,$data['catId']);
            $body    = $this->fm->validation($data['body']);
            $body    = mysqli_real_escape_string($this->db->link,$data['body']);
            $price   = $this->fm->validation($data['price']);
            $price   = mysqli_real_escape_string($this->db->link,$data['price']);
            $type    = mysqli_real_escape_string($this->db->link,$data['type']);
            $brandId =  mysqli_real_escape_string($this->db->link,$data['brandId']);

            $permited  = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $files['image']['name'];
            $file_size = $files['image']['size'];
            $file_temp = $files['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "upload/".$unique_image;

            if (in_array($file_ext, $permited) === false) {
                $msg= "<p style= ' color: orange; font-size:17px' >You can upload only:-".implode(', ', $permited)."</p>";
                return $msg;
            }else{
            move_uploaded_file($file_temp, $uploaded_image);
            $query = " INSERT INTO product(proName,catId,brandId,body,price,image,type) VALUES('$proName','$catId','$brandId','$body','$price','$uploaded_image','$type')  ";
            $result = $this->db->insert($query);
                if ($result) {
                    $msg= "<p style= 'color: green; font-size:17px' > Product Inserted Successfully !  </p>";
                    return $msg;
                }   
            }
        }
        public function getpro(){
            $query = " SELECT p.* , c.catName ,b.brandName
                        FROM product as p, category as c,Brand as b
                            WHERE p.catId=c.catId AND p.brandId=b.brandId
                                ORDER BY p.proId ";
            $result = $this->db->select($query);
            return $result;       
        }
        public function getprobyid($id){
            $query = " SELECT * FROM product WHERE proId='$id' ";
            $result = $this->db->select($query);
            return $result;
        }
        public function productupdate($data,$filess,$id){
            
                $proName = $this->fm->validation($data['proName']);
                $proName = mysqli_real_escape_string($this->db->link,$data['proName']);
                $catId   = mysqli_real_escape_string($this->db->link,$data['catId']);
                $body    = $this->fm->validation($data['body']);
                $body    = mysqli_real_escape_string($this->db->link,$data['body']);
                $price   = $this->fm->validation($data['price']);
                $price   = mysqli_real_escape_string($this->db->link,$data['price']);
                $type    = mysqli_real_escape_string($this->db->link,$data['type']);
                $brandId   = mysqli_real_escape_string($this->db->link,$data['brandId']);
                $permited  = array('jpg', 'jpeg', 'png', 'gif');
                $file_name = $filess['image']['name'];
                $file_size = $filess['image']['size'];
                $file_temp = $filess['image']['tmp_name'];

                $div = explode('.', $file_name);
                $file_ext = strtolower(end($div));
                $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
                $uploaded_image = "upload/".$unique_image;
                if (!empty($file_name)) {
                    if (in_array($file_ext, $permited) === false) {
                        $msg= "<p style= ' color: orange; font-size:17px' >You can upload only:-".implode(', ', $permited)."</p>";
                        return $msg;
                    }else{
                            move_uploaded_file($file_temp, $uploaded_image);
                            $query = " UPDATE product 
                                SET
                                proName = '$proName',
                                catId   = '$catId',
                                brandId = '$brandId',
                                body    = '$body',
                                price   = '$price',
                                image   = '$uploaded_image', 
                                type    = '$type'
                                WHERE proId = '$id'";
                            $update = $this->db->update($query);
                            if ($update) {
                                $msg= "<p style= 'color: green; font-size:17px' > Product Updated Successfully !  </p>";
                                return $msg;
                            }   
                    }
                }else {
                    $query = " UPDATE product 
                                SET
                                    proName = '$proName',
                                    catId   = '$catId' ,
                                    brandId = '$brandId',
                                    body    = '$body' ,
                                    price   = '$price' ,
                                    type    = '$type'
                                WHERE proId = '$id'";
                    $update = $this->db->update($query);
                if ($update) {
                    $msg= "<p style= 'color: green; font-size:17px' > Product Updated Successfully !  </p>";
                    return $msg;
                }   
            }
        }
        public function delpdbyid($id){
            $query = " SELECT * FROM product WHERE proId= '$id' ";
            $getfile = $this->db->select($query);
            if ($getfile) {
                while ($delimg = $getfile->fetch_assoc()) {
                    $dellink = $delimg['image'];
                    unlink($dellink);
                }
            }
            $delquery = "DELETE FROM product WHERE proId = '$id'";
            $result = $this->db->delete($delquery);
            if ($result) {
                $msg = "Product Deleted Successfully !";
                return $msg;
            }
        }
        public function limitpro(){
            $query = " SELECT * FROM product ORDER BY proId LIMIT 4";
            $result = $this->db->select($query);
            return $result;
        }
        public function prepdbyid($id){
            $query = " SELECT p.* , c.catName 
                        FROM product as p, category as c
                            WHERE p.catId=c.catId
                                AND p.proId=$id ";
            $result = $this->db->select($query);
            return $result;
        }
    }
    
?>