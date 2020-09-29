<?php   include 'inc/header.php';
        include 'inc/sidebar.php';
        include '../classes/category.php';
        include "../classes/brand.php"
?>
<?php
    $id = $_GET['brandid'];
?>
<?php
    $bd = new brand();
    if ($_SERVER['REQUEST_METHOD']=='POST') {
        $brandName = $_POST['brandname'];
        $catId = $_POST['catId'];
        $updatebrand = $bd->bdupdate($brandName,$catId,$id);
    }
?>
    </span>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Brand</h2>
                
                <div class="block copyblock"> 
                <span style="color: green; font-size:15px">
        <?php
            if (isset($updatebrand)) {
                echo $updatebrand;
            }
        ?>
                </span>
                    <form action="" method="POST">
                        <?php 
                        $upbrand = $bd->upbdtbyid($id);
                        if ($upbrand) {
                            while ($value = $upbrand->fetch_assoc()){ 
                                
                        
                        ?>
                        <table class="form">					
                            <tr>
                                <td>
                                    <input type="text" name="brandname" value="<?php echo $value['brandName']; ?>" class="medium" required />
                                </td>
                            </tr>
                            <tr>
                            </tr>
                                <td>
                                    <span> Category</span>
                                    <select id="select" name="catId" required>
                                        <option>Select Category</option>
                                        <?php
                                            $cat = new category;
                                            $getcat = $cat->getcatname();
                                            if ($getcat) {
                                                while ($result =  $getcat->fetch_assoc()) {
                                            ?>
                                        <option
                                                <?php
                                                    if ($value['catId']==$result['catId'] ) {?>
                                                        selected =  "selected";
                                                        <?php   } ?>
                                                
                                        value="<?php echo $result['catId'] ;?>"  >  <?php echo $result['catName'] ;?>  
                                        </option>
                                        <?php    }    
                                            }
                                        ?> 
                                    </select>
                                </td>
                            </tr>
                            <tr> 
                                <td>
                                    <input type="submit" name="submit" Value="Update" />
                                </td>
                            </tr>
                        </table>
                        <?php    } }
                        ?>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>