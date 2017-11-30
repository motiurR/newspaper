<?php include '../classes/VotingPool.php';?>

<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php
    $pool = new VotingPool();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $upans = $pool->updateanswer($_POST);
    }

?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Answer</h2>

                <p style="text-align: center;">
                    <?php
                 if (isset($upans)) {
                     echo $upans;
                 }
               ?></p>
                
               <div class="block copyblock"> 
                 <form action="" method="POST">
                    <table class="form">

                        <tr>
                            <td>
                                <label>Option</label>
                            </td>
                            <td>
                                <input type="text" name="option" placeholder="Enter option" class="medium" />
                            </td>
                        </tr>

						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>

                    </table>
                    </form>
                </div>
            </div>
        </div>


<?php include 'inc/footer.php';?>