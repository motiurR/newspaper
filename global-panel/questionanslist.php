<?php include '../classes/VotingPool.php';?>

<?php
    $pool = new VotingPool();
    if (isset($_GET['delqans'])) {
    	$id = $_GET['delqans'];
    	$delVotans =$pool->delVotansById($id);
    	echo "<script>window.location = 'questionanslist.php';</script>";
    }
?>

<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
            
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Sl</th>
							<th>Question</th>
							<th>Option</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
			<?php
				$gevot = $pool->getAllVotQnAns();
				if ($gevot) {
					$i = 0;
					while ($result = $gevot->fetch_assoc()) {
						$i++;
			?>
						<tr class="odd gradeX">
							<td><?php echo $i;?></td>
							<td><?php echo $result['question']?></td>
							<td><?php echo $result['option']?></td>

				            <td>
						  <?php if (Session::get('level') == '0') { ?>
				              || <a onclick="return confirm('Are You Sure Want To Delete?') " href="?delqans=<?php echo $result['id']?>">Delete</a>
				        <?php } ?>  
				            </td>

						</tr>
				<?php } } ?>		
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

