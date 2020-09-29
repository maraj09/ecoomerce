<?php   include 'inc/header.php';
        include 'inc/sidebar.php';
        include '../classes/category.php';
?>
<?php
    $id = $_GET['catid'];
?>
<?php
    $cat = new category();
    if ($_SERVER['REQUEST_METHOD']=='POST') {
        $catName = $_POST['catName'];
        $updateCat = $cat->catupdate($catName,$id);
    }
?>
    </span>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Category</h2>
                
                <div class="block copyblock"> 
                <span style="color: green; font-size:15px">
        <?php
            if (isset($updateCat)) {
                echo $updateCat;
            }
        ?>
                    <form action="" method="POST">
                        <?php 
                        $upcat = $cat->upcatbyid($id);
                        if ($upcat) {
                            while ($result = $upcat->fetch_assoc()) {
                                
                        
                        ?>
                        <table class="form">					
                            <tr>
                                <td>
                                    <input type="text" name="catName" value="<?php echo $result['catName']; ?>" class="medium" required />
                                </td>
                            </tr>
                            <tr> 
                                <td>
                                    <input type="submit" name="submit" Value="Save" />
                                </td>
                            </tr>
                        </table>
                        <?php    }
                        }?>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>