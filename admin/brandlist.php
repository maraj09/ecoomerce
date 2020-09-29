<?php 
	include 'inc/header.php';
	include 'inc/sidebar.php';
	include '../classes/category.php';
	include '../classes/brand.php';
?>
<?php
	$bd = new brand();
	if (isset($_GET['brandid'])) {
		$id = $_GET['brandid'];
		$delbrand = $bd->delbrandbyid($id);
	}
	
	$getbd =  $bd->getbdname();
?>
        <div class="grid_10">
            <div class="box round first grid">
				<h2>Category List</h2>
				<span style="color: red; font-size:15px "> 
				<?php
					if (isset($delbrand)) {
						echo $delbrand;
					}
				
				?>
				</span>
            <div class="block">  
				
				
                <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Brand Name</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
						
						if ($getbd ) {
							$i=0;
						while ($result =$getbd->fetch_assoc()) {
							$i++;
						
					?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['brandName'] ;?></td>
							<td><?php echo $result['catName'] ;?></td>
							<td><a href="brandedit.php?brandid=<?php echo $result['brandId'] ;?>">Edit</a> ||
							<a onclick="return  confirm('Are You Sure ?')" href="brandlist.php?brandid=<?php echo $result['brandId'] ;?>">Delete</a></td>
						</tr>
					<?php 
					}
				} ?>	
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

