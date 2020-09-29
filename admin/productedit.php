<?php 
    include 'inc/header.php';
    include 'inc/sidebar.php';
    include '../classes/product.php' ; 
    include '../classes/category.php' ; 
    include '../classes/brand.php';
?>
<?php 
    if (isset($_GET['proid'])) {
        $id = $_GET['proid'];
    }    
;?>
<?php
    $cat = new category();
    $bd = new brand();
    $pd = new product();
    if ($_SERVER['REQUEST_METHOD']== 'POST') {
        $updateproduct =$pd->productupdate($_POST,$_FILES,$id);
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Product</h2>
        <?php
                if (isset($updateproduct)) {
                    echo $updateproduct;
                }
            ?>
        <?php
            $getpro = $pd->getprobyid($id);
        ?>              
        <div class="block">
        
            <form action="" method="post" enctype="multipart/form-data">
            <?php
                if ($getpro) {
                    while ($value=$getpro->fetch_assoc()) {
                        
                    
            ?>
            <table class="form">
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="proName" value="<?php echo $value['proName']  ;?>" class="medium" required />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" name="catId" required>
                            <option>Select Category</option>
                            <?php
                                
                                $getcat = $cat->getcatname();
                                if ($getcat) {
                                    while ($result =  $getcat->fetch_assoc()) {
                                ?>
                            <option
                                    <?php
                                        if ($value['catId']==$result['catId'] ) {?>
                                            selected =  "selected";
                                            <?php   } ?>
                                    
                            value="<?php echo $result['catId'] ;?>"  >  <?php echo $result['catName'] ;?>  </option>
                            <?php    }    
                        }
                    ?> 
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Brand/Sub-Category</label>
                    </td>
                    <td>
                        <select id="select" name="brandId" required>
                            <option>Select Brand</option>
                            <?php
                                
                                $getbrand = $bd->getbdnameforpd();
                                if ($getbrand) {
                                    while ($result =  $getbrand->fetch_assoc()) {
                                ?>
                            <option
                                    <?php
                                        if ($value['brandId']==$result['brandId'] ) {?>
                                            selected =  "selected";
                                            <?php   } ?>
                                    
                            value="<?php echo $result['brandId'] ;?>"  >  <?php echo $result['brandName'] ;?>  </option>
                            <?php    }    
                        }
                    ?> 
                        </select>
                    </td>
                </tr>
				
				
				<tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="body">
                            <?php echo $value['body']  ;?>
                        </textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $value['price']  ;?>" name="price" class="medium" required />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <img src="<?php echo $value['image'] ; ?>" alt="" width="100px " height="100px"><br>
                        <input type="file" name="image"  />
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="type" required>
                            <option>Select Type</option>
                            <?php
                            if ($value['type']=='Featured') { ?>
                                <option value="Featured" selected="selected">Featured</option>
                                <option value="Non-Featured">Non-Featured</option>
                            <?php }else { ?>
                                <option value="Featured">Featured</option>
                                <option value="Non-Featured" selected="selected">Non-Featured</option>
                            <?php }
                            ?>
                            
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
            <?php 
            }
        }
            ?>
            </form>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


