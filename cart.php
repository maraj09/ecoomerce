<?php
	include './inc/header.php';
?>
<?php
    if ($_SERVER['REQUEST_METHOD']== 'POST') {
		$quantity = $_POST['quantity'];
		$cartId =$_POST['cartId'];
		$updatecart =$ct->updatecart($quantity,$cartId);
		if ($quantity<=0) {
			$delcart = $ct->delcartbyid($cartId);
		}
	}
	if (isset($_GET['cartid'])) {
		$id = $_GET['cartid'];
		$delcart = $ct->delcartbyid($id);
	}
	
?>	
<?php
	if (!isset($_GET['id'])) {
		echo "<meta http-equiv='refresh' content='0;URL=?id=live'/>";
	}
?>
	<div class="container ">
		<div class="YourCart">
			<h2>Your Cart</h2>
		</div>
		<div class="chartcontent clear">
				<table class="charttable">
					<tr>
						<th width="3%"> SL</th>
						<th width="20%">Product Name</th>
						<th class="none" width="10%">Image</th>
						<th class="none" width="15%">Price</th>
						<th width="20%">Quantity</th>
						<th width="15%">Total Price</th>
						<th width="5%">Action</th>
					</tr>
					<?php
						$getpro = $ct->getpro();
						if ($getpro) {
							$i=0;
							$sum=0;
							$qty = 0;
							while ($result=$getpro->fetch_assoc()) {
								$i++;
						if (isset($delcart)) {
							echo $delcart;
						}
					?>
					<tr>
						<td><?php echo $i   ;?></td>
						<td><?php echo $result['proName']  ;?></td>
						<td class="none" class="mobilehide"><img src='admin/<?php echo $result['image']  ;?>' width="60px" height="40px" alt=""/></td>
						<td class="none">Tk. <?php echo $result['price']  ;?></td>
						<td>
							<form action="" method="post">
								<input type="hidden" name="cartId" value="<?php echo $result['cartId']  ;?>">
								<input type="number" class="cartquantity" name="quantity" value="<?php echo $result['quantity']  ;?>"/>
								<input type="submit" class="chartsubmit" name="submit" value="Update"/>
							</form>
						</td>
						<td>Tk. <?php echo $total=$result['price']*$result['quantity']  ;?></td>
						<td><a onclick="return  confirm('Are You Sure ?')" href="cart.php?cartid=<?php echo $result['cartId'] ;?>">X</a></td>
					</tr>
					<?php
					$qty=$qty+$result['quantity'];
					Session::set("qty",$qty);
					$sum = $sum +$total;
					?>
					<?php
					}
				}
					?>
				</table>
			<br>
			<?php
			$getdata = $ct->cartqty();
			if ($getdata){
			?>
			<table class="totalvalue">
				<tr >
					<th>Sub Total : </th>
					<td>TK. <?php echo $sum  ;?></td>
				</tr>
				<tr>
					<th>VAT :  </th>
					<td>10%</td>
				</tr>
				<tr>
					<th>Grand Total :</th>
					<td>TK.  <?php $vat=$sum*.1; 
					echo $vat+$sum?> </td>
				</tr>
			</table>
			<?php
			}else{
				echo " <h5 style='text-align:center; color:blue'> *Your Cart Is Empty !*</h5>";
		}
			?>
		</div><br>
		<div class="shopping row">
			<div class="shopleft col-sm-12 col-md-5">
				<a href="index.php"> <img src="images/shop.png"  width="85%" alt="" /></a>
			</div>
			<div class="shopright col-sm-12 col-md-5">
				<a href="login.html"> <img src="images/check.png"  width="85%" alt="" /></a>
			</div>
		</div>	
	</div>
<?php
    include './inc/footer.php';
?>


