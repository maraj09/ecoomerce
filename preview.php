<?php
    include './inc/header.php';
?>
<?php
	$id = $_GET['proid'];
	$prepro = $pd->prepdbyid($id);	
?>
<?php
    if ($_SERVER['REQUEST_METHOD']== 'POST') {
		$quantity = $_POST['quantity'];
        $insertquantity =$ct->insertcart($quantity,$id);
    }
?>	
	<div class="container">
		<div class="row justify-content-center">
			<?php
				if ($prepro) {
					while ($result=$prepro->fetch_assoc()) { ?>
			<div class="col-sm-12 col-md-7 col-lg-6 col-xl-5">
				<img src="./admin/<?php echo $result['image'] ;?>" alt="" srcset="">
			</div>
			<div class="col-sm-12 col-md-5 col-lg-4 mt-5 col-xl-4 preright">
				<h2><?php echo $result['proName'] ;?></h2><br>
				<h4>Price : <?php echo $result['price'] ;?></h4><br>
				<h5>Category : <?php echo $result['catName'] ;?></h5><br>
				<form action="" method="post">
					<span class="Quantity">Quantity :</span>
					<input type="number" class="buyfield" min="1"  name="quantity" value="1"/>
					<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
				</form>
				<h4 style="color: red">
					<?php
						if (isset($insertquantity)){
							echo $insertquantity;
						}
					?>
				</h4>			
			</div>
			<div class="col-12 description">
				<h3>Product Details</h3>
				<?php echo $result['body'] ;?><br>
				
			</div>
			<?php
			}
		}
			?>
		</div>
	</div>
<?php
    include './inc/footer.php';
?>

