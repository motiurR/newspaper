<?php include '../classes/VotingPool.php';?>

<?php
    $pool = new VotingPool();
    /*category delete*/
    if (isset($_GET['delQes'])) {
    	$id = $_GET['delQes'];
    	$delquesy =$pool->delQuestionByid($id);
    }
?>
<?php
   $pool = new VotingPool();
    if (isset($_GET['status'])) {
    	$id = $_GET['status'];
    	$changequeststus =$pool->changeQuesStatusById($id);
    	echo "<script>window.location = 'questionlist.php';</script>";
    }
?>

<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Question List</h2>
            
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Sl</th>
							<th>Title</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
			<?php
				$getques = $pool->getallques();
				if ($getques) {
					$i = 0;
					while ($result = $getques->fetch_assoc()) {
						$i++;
			?>
						<tr class="odd gradeX">
							<td><?php echo $i;?></td>
							<td><?php echo $result['question']?></td>
							<td>
								<a href="?status=<?php echo $result['id']?>" onclick="return confirm('Are You Sure Want To Change?') " style="color:<?php echo $result['status']?'green':'red'; ?>"><?php echo $result['status']?'active':'in-active'; ?></a>
							</td>

				            <td><a href="questionedit.php?quesedt=<?php echo $result['id']?>">Edit</a> 

				 			 <?php if (Session::get('level') == '0') { ?>

				            || <a onclick="return confirm('Are You Sure Want To Delete?') " href="?delQes=<?php echo $result['id']?>">Delete</a>
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

