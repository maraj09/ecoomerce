<?php 
    include 'inc/header.php';
    include 'inc/sidebar.php';
    include '../classes/product.php' ; 
    include '../classes/category.php' ;
    include '../classes/brand.php';
?> 
<?php
    $pd = new product();
    if ($_SERVER['REQUEST_METHOD']== 'POST') {
        $insertproduct =$pd->productinsert($_POST,$_FILES);
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Product</h2>
        <?php
                if (isset($insertproduct)) {
                    echo $insertproduct;
                }
            ?>          
        <div class="block">
        
            <form action="" method="post" enctype="multipart/form-data">
            
            <table class="form">
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="proName" placeholder="Enter Product Name..." class="medium" required />
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
                                $cat = new category;
                                $getcat = $cat->getcatname();
                                if ($getcat) {
                                    while ($result =  $getcat->fetch_assoc()) {
                                ?>
                            <option value="<?php echo $result['catId'] ;?>"><?php echo $result['catName'] ;?></option>
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
                                $bd = new brand();
                                $getbrand = $bd->getbdname();
                                if ($getbrand) {
                                    while ($result =  $getbrand->fetch_assoc()) {
                                ?>
                            <option value="<?php echo $result['brandId'] ;?>"><?php echo $result['brandName'] ;?></option>
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
                        <textarea class="tinymce" name="body"></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Enter Price..." name="price" class="medium" required />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <input type="file" name="image" required />
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="type" required>
                            <option>Select Type</option>
                            <option value="Featured">Featured</option>
                            <option value="Non-Featured">Non-Featured</option>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Save" />
                    </td>
                </tr>
            </table>
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


