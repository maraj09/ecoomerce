<?php
    class brand{
        private $db;
        private $fm;

        public function __construct(){
            $this->db= new Database();
            $this->fm= new Format();
        }
        public function brandInsert($brandName,$catId){
            $brandName =$this->fm->validation($brandName);
            $brandName = mysqli_real_escape_string($this->db->link,$brandName);
            $query = "INSERT INTO brand(brandName,catId) VALUES ('$brandName','$catId') ";
            $brandInsert = $this->db->insert($query);
            if ($brandInsert) {
                $msg = "Category Inserted Successfully !";
                return $msg;
            }
        }
        public function limitbd($catid){
            $query = " SELECT* FROM brand WHERE catId='$catid'";
            $result = $this->db->select($query);
            return $result;
        }
        public function getbdname(){
            $query = "SELECT b.* , c.catName 
            FROM brand as b, category as c
                WHERE b.catId=c.catId
                    ORDER BY b.brandId ";
            $result = $this->db->select($query);
            return $result;
        }
        public function delbrandbyid($id){
            $query = "DELETE FROM brand  WHERE brandId='$id'";
            $result = $this->db->delete($query);
            if ($result) {
                $msg = "Brand Deleted Successfully !";
                return $msg;
            }
        }
        public function upbdtbyid($id){
            $query = "SELECT b.* , c.catName 
                        FROM brand as b, category as c
                            WHERE b.catId=c.catId
                                AND brandId='$id' ";
            $result = $this->db->select($query);
            return $result;
        }
        public function bdupdate($brandName,$catId,$id){
            $query ="UPDATE brand SET brandName='$brandName' , catId='$catId'  WHERE brandId='$id' ";
            $result = $this->db->update($query);
            if ($result) {
                $msg = "Category Updated Successfully !";
                return $msg;
                
            }
        }
        public function getbdnameforpd(){
            $query = " SELECT* FROM brand ";
            $result = $this->db->select($query);
            return $result;
        }
}
?>