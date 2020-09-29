<?php ob_start(); ?>
<?php
    class cart{
        private $db;
        private $fm;

        public function __construct(){
            $this->db= new Database();
            $this->fm= new Format();
        }
        public function insertcart($quantity,$id){
            $sId = session_id();
            $query = " SELECT * FROM product WHERE proId = '$id'";
            $result = $this->db->select($query)->fetch_assoc();
            $proName = $result['proName'];
            $price = $result['price'];
            $image = $result['image']; 
            $checkquery = " SELECT * FROM cart WHERE proId = '$id' AND sId ='$sId ' ";
            $result =$this->db->select($checkquery);
            if ($result) {
                $msg = "Product Already Added !";
                return $msg;
            }else{
                $query = " INSERT INTO cart(sId,proId,proName,price,quantity,image) VALUES('$sId','$id','$proName','$price','$quantity','$image')  ";
                $insert_cart = $this->db->insert($query);
                if ($insert_cart){
                    header("location:cart.php");
                    ob_flush(); 
                }
            }
        }
        public function getpro(){
            $sId = session_id();
            $query =  " SELECT * FROM cart WHERE sId= '$sId' ";
            $result = $this->db->select($query);
            return $result;
        }
        public function updatecart($quantity,$id){
            $query ="UPDATE cart SET quantity='$quantity' WHERE cartId='$id' ";
            $result = $this->db->update($query);
            if ($result) {
                header("location:cart.php");
            }
        }
        public function delcartbyid($id){
            $query = "DELETE FROM cart  WHERE cartId='$id'";
            $result = $this->db->delete($query);
            if ($result) {
                header("location:cart.php");
            }
        }
        public function cartqty(){
            $sId = session_id();
            $query =  " SELECT * FROM cart WHERE sId= '$sId' ";
            $result = $this->db->select($query);
            return $result;
        }
    }

?>