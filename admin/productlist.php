<?php 
    include 'inc/header.php';
	include 'inc/sidebar.php';
	include '../classes/product.php'; 
	include '../classes/category.php';
?>
<?php 
	$pd = new product();
	$fm= new Format();
?>
<?php
	if (isset($_GET['proid'])) {
		$id = $_GET['proid'];
		$delpro = $pd->delpdbyid($id);
	}
	
	?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <div class="block"> 
			<p style="color:red; ">
			<?php
				if(isset($delpro)) {
					echo $delpro;
				}
			?>
			</p> 
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>SL</th>
					<th>Product Name</th>
					<th>Category</th>
					<th>Brand/Sub-Category</th>
					<th>Description</th>
					<th>Price</th>
					<th>Image</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$getpd = $pd->getpro();
					if ($getpd) {
						$i=0;
						while ($result=$getpd->fetch_assoc()) {
							$i++;
						
				?>
				<tr class="odd gradeX">
					<td><?php echo $i ;?></td>
					<td><?php echo $result['proName'] ;?></td>
					<td><?php echo $result['catName'] ;?></td>
					<td><?php echo $result['brandName'] ;?></td>
					<td><?php echo $fm->textShorten($result['body'],35) ;?></td>
					<td>&#2547 <?php echo $result['price'] ;?></td>
					<td><img src="<?php echo $result['image'] ; ?>" alt="" width="60px " height="50px" style="margin-bottom: -20px;"></td>
					<td><?php echo $result['type'] ;?></td>
					<td><a href="productedit.php?proid=<?php echo $result['proId'] ;?>">Edit</a> ||
							<a onclick="return  confirm('Are You Sure ?')" href="productlist.php?proid=<?php echo $result['proId'] ;?>">Delete</a></td>
				</tr>
				<?php }
					}
				?>
			</tbody>
		</table>

        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
