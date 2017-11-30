<?php include '../classes/VotingPool.php';?>

<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php
    $pool = new VotingPool();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $insertans = $pool->addanswer($_POST);
    }

?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Answer</h2>

                <p style="text-align: center;">
                    <?php
                 if (isset($insertans)) {
                     echo $insertans;
                 }
               ?></p>
                
               <div class="block copyblock"> 
                <h2 style="text-align: center;">পর্যায়ক্রমে ততবার উত্তর লিখুন যতবার উত্তর আপনি দেখাতে চান।</h2><br>
                 <form action="" method="POST">
                    <table class="form">

                        <tr>
                            <td>
                                <label>Question</label>
                            </td>
                            <td>
                                <select name="poll_id">
                                <?php
                                $pool = new VotingPool();
                                    $getques = $pool->getAllQuestionforaddAns();
                                    if ($getques) {
                                        while ($result = $getques->fetch_assoc()) {
                                ?>  
                                    <option value="<?php echo $result['id']; ?>">
                                        <?php echo $result['question']; ?>  
                                    </option>
                                <?php } } ?>    
                                </select>
                            </td>
                        </tr>


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