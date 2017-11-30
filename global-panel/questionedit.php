<?php include '../classes/VotingPool.php';?>

<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php
    if (!isset($_GET['quesedt']) || $_GET['quesedt'] == NULL) { 
        echo "<script>window.location = 'questionlist.php';</script>";
    }else{
        $id =  $_GET['quesedt'];
    }
?>

<?php
    $pool = new VotingPool();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $updateques= $pool->Updatequestiom($_POST, $id);
    }

?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Category</h2>

                <p style="text-align: center;">
                    <?php
                 if (isset($updateques)) {
                     echo $updateques;
                 }
               ?></p>
                
               <div class="block copyblock"> 

                 <form action="" method="POST">
            <?php
                $showques = $pool->getquesforshow($id);
                if ($showques) {
                    while ($result = $showques->fetch_assoc()) {
            ?>        
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="question" value="<?php echo $result['question']; ?>" class="medium" />
                            </td>
                        </tr>

						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>

                    </table>

            <?php } } ?>
                    
                    </form>
                </div>
            </div>
        </div>


<?php include 'inc/footer.php';?>