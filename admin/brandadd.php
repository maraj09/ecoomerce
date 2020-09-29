<?php   include 'inc/header.php';
        include 'inc/sidebar.php';
        include '../classes/category.php';
        include "../classes/brand.php";
?>
    
    <?php
        $bd = new brand();
        if ($_SERVER['REQUEST_METHOD']=='POST') {
            $brandName = $_POST['brandName'];
            $catId = $_POST['catId'];
            $insertbrand = $bd->brandInsert($brandName,$catId);
        }
    ?>
    
    </span>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Brand</h2>
                
                <div class="block copyblock"> 
                <span style="color: green; font-size:15px">
        <?php
            if (isset($insertbrand)) {
                echo $insertbrand;
            }
        ?>
    <form action="" method="POST">
        <table class="form">					
                            <tr>
                                <td>
                                    <input type="text" name="brandName" placeholder="Enter Brand or Sub-Category Name..." class="medium" required />
                                </td>
                            </tr>
                            <tr>
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
                                        <?php  }    
                                            }
                                        ?> 
                                    </select>
                                </td>
                            </tr>
                            <tr> 
                                <td>
                                    <input type="submit" name="submit" Value="Save" />
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>