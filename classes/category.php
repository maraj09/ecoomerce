<?php
    class category{
        private $db;
        private $fm;

        public function __construct(){
            $this->db= new Database();
            $this->fm= new Format();
        }
        public function catInsert($catName){
            $catName =$this->fm->validation($catName);
            $catName = mysqli_real_escape_string($this->db->link,$catName);
            $query = "INSERT INTO category(catName) VALUES ('$catName') ";
            $catInser = $this->db->insert($query);
            if ($catInser) {
                $msg = "Category Inserted Successfully !";
                return $msg;
            }
        }
        public function getcatname(){
            $query = " SELECT * FROM category ORDER BY catId ";
            $result = $this->db->select($query);
            return $result;
        }
        public function upcatbyid($id){
            $query = " SELECT * FROM category WHERE catId='$id' ";
            $result = $this->db->select($query);
            return $result;
        }
        public function catupdate($catName,$id){
            $catName =$this->fm->validation($catName);
            $catName = mysqli_real_escape_string($this->db->link,$catName);
            $query ="UPDATE category SET catName='$catName' WHERE catId='$id' ";
            $result = $this->db->update($query);
            if ($result) {
                $msg = "Category Updated Successfully !";
                return $msg;
                
            }
        }
        public function delcatbyid($id){
            $query = "DELETE FROM category  WHERE catId='$id'";
            $result = $this->db->delete($query );
            if ($result) {
                $msg = "Category Deleted Successfully !";
                return $msg;
            }
        }
        public function limitcat(){
            $query = " SELECT * FROM category ORDER BY catId  ";
            $result = $this->db->select($query);
            return $result;
        }
    }
?>