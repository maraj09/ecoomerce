
<?php
    include './inc/header.php';
?>
    <div class="content">
        <div class=" container  midpage ">
            <div class="header">
                <h6>*HOT DEALS*</h6>
            </div>
            <div class="row ">
                <?php
                    $getpro =  $pd->limitpro();
                        if ($getpro) {
                        while ($result = $getpro->fetch_assoc()) { ?>  
                <div class="card  col-6 col-sm-6 col-md-3 " >
                    <div class="card-body">
                        <a href="./preview.php?proid=<?php echo $result['proId']; ?>"> <img src="admin/<?php echo $result['image']; ?>" alt="" srcset="" width="100%" height="190" ></a>
                        <a href="./preview.php?proid=<?php echo $result['proId']; ?>" ><p class="card-text"><?php echo $result['proName']; ?></p></a>
                        <div class="price">
                            <h4 class="taka">&#2547</h4>
                            <p class="taka"><?php echo $result['price']; ?></p>
                        </div>
                        <div class=""> 
                            <a href="./preview.php?proid=<?php echo $result['proId']; ?>"><button type="button" class=" buynow ">Details</button></a> 
                        </div>
                    </div>
                </div>
                <?php
                        }
                    }
                ?>
            </div> 
            <div class="footer">
                <!-- NONE -->
            </div>
        </div>
    </div>
<?php
    include './inc/footer.php';
?>
    
        
        
        
    