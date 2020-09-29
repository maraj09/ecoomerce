<?php 
	include 'inc/header.php';
	include 'inc/sidebar.php';
	include '../classes/category.php';

?>
<?php
	$cat = new category();
	if (isset($_GET['catid'])) {
		$id = $_GET['catid'];
		$delcat = $cat->delcatbyid($id);
	}
	$getcat =  $cat->getcatname();
	?>
        <div class="grid_10">
            <div class="box round first grid">
				<h2>Category List</h2>
				<span style="color: red; font-size:15px "> 
				<?php
					if (isset($delcat)) {
						echo $delcat;
					}
				
				?>
				</span>
            <div class="block">  
				
				
                <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
						
						if ($getcat) {
							$i=0;
						while ($result = $getcat->fetch_assoc()) {
							$i++;
						
					?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['catName'] ;?></td>
							<td><a href="catedit.php?catid=<?php echo $result['catId'] ;?>">Edit</a> ||
							<a onclick="return  confirm('Are You Sure ?')" href="catlist.php?catid=<?php echo $result['catId'] ;?>">Delete</a></td>
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

